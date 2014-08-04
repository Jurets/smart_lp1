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
            $model = new CommonStatistics;
            
            $this->render('index', array('model'=>$model));
        }
        public function actionGraph(){
            if (Yii::app()->request->isAjaxRequest){
                $graph_choise = $_POST['graph_choise'];
                $model = new CommonStatistics($graph_choise);
            }
        }
}


