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
   public $transactionKind = ''; // вид транзакции - передается в справочник видов транзакций
   public $notation=''; // комментарии
   
   protected $output; // данные от PM интерфейса
   public function getOutput(){  // извлечение данных PM интерфейса
       return $this->output;
   }
   
   private $paymentTransactionStatus; // записываем текст для пользователя в зависимости от вызванного события
   public $message; //сюда  передать нужный текст (в init() - default в качестве примера )
   
   private $API; // The Component
   
  public function init(){
      $this->API = Yii::app()->perfectmoney;
      $this->API->onSuccess = array($this, 'successBusinessLogic');
      $this->API->onFailure = array($this, 'failureBusinessLogic');
      /*Соглашение о выводе информации пользователю - образец*/
      $this->message['success'] = 'Оплата произведена успешно';
      $this->message['failure'] = 'В процессе оплаты произошла ошибка. Для разъяснений обратитесь к администратору сайта';
  }
  
  public function successBusinessLogic($event){ // Обработчик события для компонентва API "ОПЛАТА ОКЕЮШКИ"
      $this->output = $event->sender->dataOut();
      if($event->sender->choise === 'confirm'){
          $this->confirmSuccessHelper($event);
      }
      
      $this->addError('paymentTransactionStatus', $this->message['success']);
  }
  public function failureBusinessLogic($event){ // Обработчик события для компонента API "ОПЛАТА НЕ ПРОШЛА"
      $this->output = $event->sender->dataOut('ERROR');
      if($event->sender->choise === 'confirm'){
          $this->confirmFailureHelper($event);
      }         
      $this->addError('paymentTransactionStatus',$this->message['failure']);
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
           //array('payerAccount, payeeAccount', 'checkPurseFormat'),
           array('payerId, payeeId', 'type', 'type'=>'integer'),
           array('notation', 'length', 'max'=>255),
           array('transactionKind', 'length', 'max'=>255),
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
      $kind_id = false;
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
  }
  private function confirmFailureHelper($event){
      $dbObject = Yii::app()->db;
      $kind_id = false;      
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
  }
}