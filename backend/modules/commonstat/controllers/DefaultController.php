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
        
        public function actionIndex(){
            ChartJsOnceInit::onceInit();
            $model = new CommonStatistics;
            $this->render('index', array('model'=>$model));
        }
        public function actionGraph(){
            if (Yii::app()->request->isAjaxRequest){
                $model = new CommonStatistics;
                if(isset($_POST['begin'])){//test for filters - to model postAnalyse()
                    $model->dateValidate();
                    var_dump($_POST);
                }
                $model->demoTest();
                $this->renderPartial('_graph',array('model'=>$model),FALSE, TRUE);
            }
        }
        public function actionTest(){
          
        }
}

