<?php
class DefaultController extends EMController {
    public $layout='//layouts/column2';
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}    
        
    /* Формирование вручную (для первого интервала) */
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

