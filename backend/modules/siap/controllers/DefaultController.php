<?php
class DefaultController extends EController {
    public $layout='//layouts/column2';
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
    public function actionIndex(){ // testovichek
        $test = '3';
        $model = new SiapPeriodes;
        $model->test = $test;
        
        
        if(!$model->validate()){
            throw new CHttpException('500', 'invalid parameters');
        }
        $this->render('index', array('model'=>$model));
    }
    public function actionPaymentPeriod(){
        
    }
    /*  */
    public function actionPeriodManually(){
        $model = new SiapPeriodes;
        $check = FALSE;
        if(isset($_POST['begin'])){
            $check = TRUE;
            $model->begin = $_POST['begin'];
            $model->addWeek();
            if($model->validate()){
                 $this->render('setperiodsuccess', array('model'=>$model));
                 $model->save();
                 return true;
            }
        }
        $this->render('setperiod', array('model'=>$model, 'check'=>$check));
    }

}