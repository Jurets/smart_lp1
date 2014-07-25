<?php
class SiapExecute extends CActiveRecord{
//    public $period_id;
//    public $begin;
//    public $end;
    
    protected  $instructions;
    protected static $systemPurses;
    
    //public static $PM; // Модель для взаимодействия с API Perfect Money
    
    /* параметры для API PM */
    
    public function init() {
        
    }
    public function tableName() {
        return 'sip_instructions';
    }
    public static function executeInstructions(){
        SiapExecute::setSystemPurses();
        $model = new SiapExecute;
        $models = $model->findAllByAttributes(array('instruction_result'=>0));
        foreach($models as $model){
            $model->paymentThrowAPI();
        }
    }
     public static function model($className=__CLASS__)
    {
	return parent::model($className);
    }
    protected function paymentThrowAPI(){
       
         $model = new PerfectMoney();
        /* обязательные параметры */
        $model->login = SiapExecute::$systemPurses['_login'];
        $model->password = SiapExecute::$systemPurses['_pass'];
        $model->payerAccount = SiapExecute::$systemPurses['B'];
        $model->payeeAccount = $this->purse;
        $model->amount = $this->amount;
        $model->payeeId = $this->user_id;
        $model->transactionId = $this->tr_kind_id;
        /* необязательные параметры */
        $model->notation = 'Weekly Payments';
        
        $transaction = Yii::app()->db->beginTransaction();
        try{
            if($this->save()){
                $transaction->commit();
                $model->Run();
                if(is_null($model->getError('paymentTransactionStatus'))){
                    $this->instruction_result = 1;
                    $this->save();
                }
            
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            
        }
        
        
        
    }
    /* Служебное */
    protected static function setSystemPurses(){ // запускается при ините объекта модели
        $systemPursesSQL = 'SELECT purse_activation, purse_club, bpm_login, bpm_password, purse_fdl FROM requisites WHERE id = "JVMS" ';
        $systemPurses = Yii::app()->db->createCommand($systemPursesSQL)->query()->read();
        if(is_null($systemPurses)){
            throw new CHttpException('500', 'System purses not found, check the requisites table');
        }
        SiapExecute::$systemPurses = array(
            'A'=>$systemPurses['purse_activation'],
            'B'=>$systemPurses['purse_club'],
            'F'=>$systemPurses['purse_fdl'],
            '_login'=>$systemPurses['bpm_login'],
            '_pass'=>$systemPurses['bpm_password'],
        );
    }
}
