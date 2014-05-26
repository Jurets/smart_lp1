<?php

class DefaultController extends EController
{
    public $layout='//layouts/column2';
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
    
	public function actionIndex()
	{
                $model = new Indexmanager;
                $model->LoadIndexManager(); // запрос к itemsstorage по параметру INDEX_MANAGER
                if(isset($_POST['Indexmanager'])){
                    $model->attributes = $_POST['Indexmanager'];
                    $model->setSliderList($_POST['sliderlist']);
                    $model->SaveIndexManager();
                }
                    
		$this->render('index', array('model'=>$model));
	}
     
    public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
		);
	}
}