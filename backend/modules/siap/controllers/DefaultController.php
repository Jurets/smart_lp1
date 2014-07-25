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

    
    /* Заготовка для крона */
    
    /* Автоматическое формирование (отталкиваемся от первого и последующих по свежей дате) - тестовый */
    public function actionInstructionProcess(){
        // автоматически создаем новый период, отталкиваясь от предидущего (получаем period_id, date_begin, date_end)
        $periodSource = SiapPeriodes::dateIntervalAutomate();
         //Test
//        $periodSource = array(
//            'period_id'=>1,
//            'date_begin'=>'2014-07-16 12:00:00',
//            'date_end'=>'2014-07-23 12:00:00',
//        );
        
      //  $periodSource = SiapInstructions::makePeriodInstructions($periodSource); // создаются инструкции за новый период, созданный автоматически
        
        SiapExecute::executeInstructions(/*$periodSource['period_id']*/); // теперь эти инструкции выполняются
        
    }
    
}

