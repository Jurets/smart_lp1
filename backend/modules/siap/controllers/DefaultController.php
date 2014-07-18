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

    /* Автоматическое формирование (отталкиваемся от первого и последующих по свежей дате) - тестовый */
    public function actionInstructionProcess(){
        // автоматически создаем новый период, отталкиваясь от предидущего (получаем period_id, date_begin, date_end)
       // $periodSource = SiapPeriodes::dateIntervalAutomate();
        $periodSource = array(
            'period_id'=>1,
            'date_begin'=>'2014-07-15 12:00:00.00',
            'date_end'=>'2014-07-22 12:00:00',
        ); //Test
        SiapInstructions::makePeriodInstructions($periodSource);
        
    }
    /* Служебное  */
    protected function makeB(){
        
    }
}

