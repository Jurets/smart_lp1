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
    public function actionPeriodManually(){
        $model = new SiapPeriodesManually;
        if(isset($_POST)){
            $model->attributes = $_POST;
            if($model->save()){
                $this->renderPartial('_setperiodsuccess', array('model'=>$model));
                return true;
            }
        }
        $this->render('setperiod', array('model'=>$model));
    }
}