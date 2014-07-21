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
      $this->message['success'] = 'Оплата произведена успешно';
      $this->message['failure'] = 'В процессе оплаты произошла ошибка. Для разъяснений обратитесь к администратору сайта';
      $this->message['errorText'] = '';
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

  /* Сердце Модели */
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
        return false;
  }
   
  public function rules(){
       return array(
           array('login, password', 'required'),
           array('payerId, payeeId, transactionId', 'type', 'type'=>'integer'),
           array('notation', 'length', 'max'=>255),
           //array('transactionKind', 'length', 'max'=>255), // параметр запрещен к использованию
       );
   }
      
  /*Собственная Валидация */
   public function checkPurseFormat($attribute, $params){
       // U - доллар E - евро G - золото
       $checked = $this->$attribute;
       if(substr($checked, 0, 1) !== 'U'){
          $this->addError($attribute, 'Purse must be a dollar context');
       }
   }
  /* Служебные вспомогательные методы */
  private function confirmSuccessHelper($event){
      $dbObject = Yii::app()->db;
      $transaction = $dbObject->beginTransaction();
      try {
        $kind_id = false;
        if(isset($this->transactionId)){ //установка поля tr_kind_id вручную
            $act_id = (int)$this->transactionId;
        }else{ // установка поля tr_kind_id автоматически
              $isExist = $dbObject->createCommand()
              ->select('kind_id')
              ->from('pm_transaction_kind')
             ->where('description=:desc', array(':desc'=>$this->transactionKind))
              ;
          $read = $isExist->query();
          $kind_id = $read->read();
          if($kind_id == false){
               $dbObject->createCommand()
               ->insert('pm_transaction_kind', array('description'=>$this->transactionKind));
               $act_id = Yii::app()->db->getLastInsertID();
          }else{
               $act_id = $kind_id['kind_id'];
          }

        }
        $dbObject->createCommand()
          ->insert('pm_transaction_log', array(
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
  private function confirmFailureHelper($event){
      $dbObject = Yii::app()->db;
      $transaction = $dbObject->beginTransaction();
      try{
        $kind_id = false;
        if(isset($this->transactionId) && is_int($this->transactionId)){
            $act_id = $this->transactionId;
        }else{
          $isExist = $dbObject->createCommand()
            ->select('kind_id')
            ->from('pm_transaction_kind')
            ->where('description=:desc', array(':desc'=>$this->transactionKind))
            ;
          $read = $isExist->query();
          $kind_id = $read->read();
          if($kind_id == false){
             $dbObject->createCommand()
              ->insert('pm_transaction_kind', array('description'=>$this->transactionKind));
             $act_id = Yii::app()->db->getLastInsertID();
          }else{
             $act_id = $kind_id['kind_id'];
          }
        }
        $isExist = $dbObject->createCommand()
            ->select('err_id')
            ->from('pm_transaction_error')
            ->where('description=:desc', array(':desc'=>$event->sender->dataOut('ERROR')))
            ;
        $read = $isExist->query();
        $err_id = $read->read();
        if($err_id == false){
           $dbObject->createCommand()
            ->insert('pm_transaction_error', array('description'=>$event->sender->dataOut('ERROR')));
           $act2_id = Yii::app()->db->getLastInsertID();
        }else{
           $act2_id = $err_id['err_id'];
        }
        $dbObject->createCommand()
          ->insert('pm_transaction_log', array(
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
            $transaction->commit();
      }catch(Exception $exception){
          // Действия по логированию в файл
          //TO DO
          
          $transaction->rollback();
      }
  
   }
}