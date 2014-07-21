<?php
class SiapExecute extends CActiveRecord{
    public $period_id;
    public $begin;
    public $end;
    
    private $dbh;
    protected $instructions;
    protected $systemPurses;
    
    //public static $PM; // Модель для взаимодействия с API Perfect Money
    
    /* параметры для API PM */
    
    public function init() {
        $this->dbh = Yii::app()->db;
        $this->setSystemPurses();
       // $this->PM = new PerfectMoney;
//        $this->PM->login = '6416431';
//        $this->PM->password = 'uhaha322re423e';
//        $this->PM->payerAccount = 'U6840713';
    }
    public function tableName() {
        return 'sip_instructions';
    }
    public static function executeInstructions($period_id){
        $model = new SiapExecute;
        $models = $model->findAllByAttributes(array('period_id'=>(int)$period_id,'instruction_result'=>0));
        foreach($models as $model){
            $model->paymentThrowAPI();
        }
        var_dump($model);
    }
     public static function model($className=__CLASS__)
    {
	return parent::model($className);
    }
    protected function test(){echo ' * ';}
    protected function paymentThrowAPI(){
       
         $model = new PerfectMoney();
        /* обязательные параметры */
        $model->login = '6416431';
        $model->password = 'uhaha322re423e';
        $model->payerAccount = $this->systemPurses['B'];
        $model->payeeAccount = $this->purse;
        $model->amount = $this->amount;
        $model->payeeId = $this->user_id;
        $model->transactionId = $this->tr_kind_id; 
        $model->notation = 'test';
        $model->Run();
        return FALSE;
        
//        $this->PM->payeeAccount = $this->purse;
//        $this->PM->payeeId = $this->user_id;
//        $this->PM->amount = $this->amount;
//        $this->PM->transactionId = $this->tr_kind_id;
//        $this->PM->notation = 'test';
//        $this->PM->Run();
//        if(is_null($this->PM->getError('paymentTransactionStatus'))){
//            //$this->instruction_result = 1;
//            //$this->save();
//        }
        
    }
    /* Служебное */
    protected function setSystemPurses(){ // запускается при ините объекта модели
        $systemPursesSQL = 'SELECT purse_activation, purse_club, purse_fdl FROM requisites WHERE id = "JVMS" ';
        $systemPurses = $this->dbh->createCommand($systemPursesSQL)->query()->read();
        if(is_null($systemPurses)){
            throw new CHttpException('500', 'System purses not found, check the requisites table');
        }
        $this->systemPurses = array(
            'A'=>$systemPurses['purse_activation'],
            'B'=>$systemPurses['purse_club'],
            'F'=>$systemPurses['purse_fdl'],
        );        
    }
}
