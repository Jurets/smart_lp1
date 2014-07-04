<?php
/* Базовая модель */
class PerfectMoney extends CFormModel {
   public $login; // PM accaunt login
   public $password; // PM Usr acc password
   public $payerAccount; // кошелек, с которого осуществляется оплата
   public $payeeAccount; // кошелек получателя
   public $amount; // сумма для передачи с кошелька на кошелек
   public $notation; // комментарии
      
   private $paymentTransactionStatus; // записываем текст для пользователя в зависимости от вызванного события
   public $message; //сюда  передать нужный текст (в init() - default в качестве примера )
   
   private $API; // The Component
   
  public function init(){
      $this->API = Yii::app()->perfectmoney;
      $this->API->onSuccess = array($this, 'successBusinessLogic');
      $this->API->onFailure = array($this, 'failureBusinessLogic');
      /*Соглашение о выводе информации пользователю*/
      $this->message['success'] = 'Оплата произведена успешно';
      $this->message['failure'] = 'В процессе оплаты произошла ошибка. Для разъяснений обратитесь к администратору сайта';
  }
  public function successBusinessLogic($event){ // Обработчик события для компонентва API "ОПЛАТА ОКЕЮШКИ"
      var_dump('S U C C E S S', $event->sender->dataOut());
      
      $this->addError('paymentTransactionStatus', $this->message['success']);
  }
  public function failureBusinessLogic($event){ // Обработчик события для компонента API "ОПЛАТА НЕ ПРОШЛА"
      var_dump('F A I L U R E', $event->sender->dataOut('ERROR'));
      
      
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
           array('payerAccount, payeeAccount', 'checkPurseFormat'),
           array('notation', 'length', 'max'=>255),
       );
   }
      
  /* Валидация */
   public function checkPurseFormat($attribute, $params){
       // U - доллар E - евро G - золото
       $checked = $this->$attribute;
       if(substr($checked, 0, 1) !== 'U'){
          $this->addError($attribute, 'Purse must be a dollar context');
       }
   }
   
}