<?php
/* Базовая модель */
class PerfectMoney extends CFormModel {
   public $login; // PM accaunt login
   public $password; // PM Usr acc password
   
   public $payerId; // id пользователя-плательщика
   public $payerAccount; // кошелек, с которого осуществляется оплата
   public $payeeId; // id пользователя-получателя
   public $payeeAccount; // кошелек получателя
   public $amount; // сумма для передачи с кошелька на кошелек
   private $transactionKind = ''; // вид транзакции - передается в справочник видов транзакций // id транзакции определяется автоматически ЗАПРЕЩЕНО
   public $transactionId; // id транзакции "как есть" - для передачи вручную
   public $notation=''; // комментарии
   
   protected $output; // данные от PM интерфейса
   public function getOutput(){  // извлечение данных PM интерфейса
       return $this->output;
   }
   
   private $paymentTransactionStatus; // записываем текст для пользователя в зависимости от вызванного события
   private $errorText; // Текст ошибки, как есть
   public $message; //сюда  передать нужный текст (в init() - default в качестве примера )
   
   private $API; // The Component
   
  public function init(){
      $this->transactionKind = 0;
      $this->API = Yii::app()->perfectmoney;
      $this->API->onSuccess = array($this, 'successBusinessLogic');
      $this->API->onFailure = array($this, 'failureBusinessLogic');
      /*Соглашение о выводе информации пользователю - умолчание*/
      $this->message['success'] = BaseModule::t('rec', 'Payment was successful');
      $this->message['failure'] = BaseModule::t('rec', 'An error occurred during the payment process. For details, contact the site administrator');
      $this->message['empty_purse'] = BaseModule::t('rec', "Recipient's or Sender's purse absent");
      $this->message['errorText'] = '';
      $this->message['nodollar_purse'] = BaseModule::t('rec','Purse must have dollar prefix');
      $this->payerId = NULL;
      $this->payeeId = NULL;
  }
  
  public function successBusinessLogic($event){ // Обработчик события для компонентва API "ОПЛАТА ОКЕЮШКИ"
      $this->output = $event->sender->dataOut();
      $this->API->detachEventHandler('onSuccess', array($this, 'successBusinessLogic')); // вариант для использования компонента pm в цикле
      $this->API->detachEventHandler('onFailure', array($this, 'failureBusinessLogic')); // вариант для использования компонента pm в цикле
      if($event->sender->choise === 'confirm'){
          $this->confirmSuccessHelper($event);
      }
  }
  public function failureBusinessLogic($event){ // Обработчик события для компонента API "ОПЛАТА НЕ ПРОШЛА"
      $this->output = $event->sender->dataOut('ERROR');
      $this->API->detachEventHandler('onSuccess', array($this, 'successBusinessLogic')); // вариант для использования компонента pm в цикле
      $this->API->detachEventHandler('onFailure', array($this, 'failureBusinessLogic')); // вариант для использования компонента pm в цикле
      if($event->sender->choise === 'confirm'){
          $this->confirmFailureHelper($event);
      }         
      $this->addError('paymentTransactionStatus',$this->message['failure']);
      $this->addError('errorText', $this->message['errorText']);
  }

  /* ----------------------- Сердце Модели ------------------ */
  
  /**
  * Запуск процесса оплаты через API-интерфейс 
  *   (с помощью команд CURL)
  * 
  * @param mixed $choise
  */
  public function Run($choise=NULL){
      if($this->validate()){
       if(!is_null($choise)){
           $this->API->choise = $choise;
       }
       $params = array(
           'AccountID'=>$this->login,
           'PassPhrase'=>$this->password,
           'Payer_Account'=>$this->payerAccount,
           'Payee_Account'=>$this->payeeAccount,
           'Amount'=>$this->amount,
       );
        $this->API->dataLoad($params);
        $this->API->dataProcess();
        return true;
      }
      $errors = $this->getErrors();
        return false;
  }

  /**
  *  Обработка: выполнение действий в БД системы
  *   (НО БЕЗ запуска API-запроса на сайт PerfectMoney) 
  * 
  * @param mixed $choise
  */
  public function Accept($choise = NULL){
      if($this->validate()) {
          if(!is_null($choise)){
              $this->API->choise = $choise;
          }
          $this->API->dataStore();
          return true;
      }
      $errors = $this->getErrors();
      return false;
  }
   
  /* ----------------------------------------- */ 
   
  public function rules(){
       return array(
           array('login, password', 'required', 'except'=>'purseTest'),
           array('payerId, payeeId, transactionId', 'type', 'type'=>'integer'),
           array('payerAccount, payeeAccount', 'isEmptyPayeeAccount', 'except'=>'purseTest'),
           array('payerAccount', 'checkPurseFormat', 'on'=>'purseTest'),
           array('notation', 'length', 'max'=>255),
           //array('transactionKind', 'length', 'max'=>255), // параметр запрещен к использованию
       );
       
   }
      
  /*Собственная Валидация */
   public function checkPurseFormat($attribute, $params){
       // U - доллар E - евро G - золото
       $checked = $this->$attribute;
       if(substr($checked, 0, 1) !== 'U'){
           $this->addError('paymentTransactionStatus', $this->message['nodollar_purse']);
       }
   }
   public function isEmptyPayeeAccount($attribute, $params){
       if(empty($this->payeeAccount)){
          $this->addError('paymentTransactionStatus',$this->message['empty_purse']);
          
       }
   }
  /* Служебные вспомогательные методы */
  public function confirmSuccessHelper($event){
  //private function confirmSuccessHelper($event){
      $dbObject = Yii::app()->db;
      $transaction = $dbObject->beginTransaction();
      try {
          $kind_id = false;
          if(isset($this->transactionId)){ //установка поля tr_kind_id вручную
              $act_id = (int)$this->transactionId;
          } else { // установка поля tr_kind_id автоматически
              $isExist = $dbObject->createCommand()
                  ->select('kind_id')
                  ->from('pm_transaction_kind')
                  ->where('description=:desc', array(':desc'=>$this->transactionKind));
              $read = $isExist->query();
              $kind_id = $read->read();
              if($kind_id == false){
                  $dbObject->createCommand()->insert('pm_transaction_kind', array('description'=>$this->transactionKind));
                  $act_id = Yii::app()->db->getLastInsertID();
              } else {
                  $act_id = $kind_id['kind_id'];
              }
          }
          $dbObject->createCommand()->insert('pm_transaction_log', array(
              'from_user_id'=>$this->payerId,
              'from_purse'=>$this->payerAccount,
              'to_user_id'=>$this->payeeId,
              'to_purse'=>$this->payeeAccount,
              'notation'=>$this->notation,
              'amount'=>$this->amount,
              'currency'=>'USD',
              'tr_kind_id'=>$act_id,
          ));
          $transaction->commit();
      } catch (Exception $exception) {
          // Действия по логированию в файл
          // TO DO
          $transaction->rollback();
      }  
  }
  
  /**
  * put your comment there...
  * 
  * @param mixed $event
  */
  private function confirmFailureHelper($event){
      $dbObject = Yii::app()->db;
      $transaction = $dbObject->beginTransaction();
      try {
          $kind_id = false;
          if(isset($this->transactionId) && is_int($this->transactionId)){
              $act_id = $this->transactionId;
          } else {
              $isExist = $dbObject->createCommand()
                  ->select('kind_id')
                  ->from('pm_transaction_kind')
                  ->where('description=:desc', array(':desc'=>$this->transactionKind));
              $read = $isExist->query();
              $kind_id = $read->read();
              if($kind_id == false){
                  $dbObject->createCommand()
                  ->insert('pm_transaction_kind', array('description'=>$this->transactionKind));
                  $act_id = Yii::app()->db->getLastInsertID();
              } else {
                  $act_id = $kind_id['kind_id'];
              }
          }
          $isExist = $dbObject->createCommand()
              ->select('err_id')
              ->from('pm_transaction_error')
              ->where('description=:desc', array(':desc'=>$event->sender->dataOut('ERROR')));
          $read = $isExist->query();
          $err_id = $read->read();
          if($err_id == false){
              $dbObject->createCommand()->insert('pm_transaction_error', array('description'=>$event->sender->dataOut('ERROR')));
              $act2_id = Yii::app()->db->getLastInsertID();
          } else {
              $act2_id = $err_id['err_id'];
          }
          $dbObject->createCommand()->insert('pm_transaction_log', array(
              'from_user_id'=>$this->payerId,
              'from_purse'=>$this->payerAccount,
              'to_user_id'=>$this->payeeId,
              'to_purse'=>$this->payeeAccount,
              'notation'=>$this->notation,
              'amount'=>$this->amount,
              'currency'=>'USD',
              'tr_kind_id'=>$act_id,
              'tr_err_code'=>$act2_id,
          ));
          // ..............................
          // commit - включить запись транзакций с ошибками в бд rollback - выключить
          $transaction->commit();
          //$transaction->rollback();
      }catch(Exception $exception){
          // Действия по логированию в файл
          //TO DO
          $transaction->rollback();
      }

  }
}