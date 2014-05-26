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
    
//        public function actions() {
//        return array(
//            'upload'=>array(
//                'class'=>'common.extensions.FileUpload.UploadAction',
//                'prefixOrigin'=>'leader-',
//                'prefixResized'=>'resized-leader-',
//                //'uploadDir'=>$this->module->uploadDir,
//                'uploadDir'=>'/uploads/',
//                'uploadUrl'=>$this->module->uploadUrl,
//            ),            
//        );
//    }
	public function actionIndex()
	{
            //print_r($_FILES);die;
                $model = new Indexmanager;
                $model->LoadIndexManager(); // запрос к itemsstorage по параметру INDEX_MANAGER
                if(isset($_POST['Indexmanager'])){
                    $model->attributes = $_POST['Indexmanager'];
                
                if (isset($_POST['sliderlist']))
                        $model->setSliderList($_POST['sliderlist']);
                    else 
                        $model->sliderlist = array();
                    
                    if(isset($_FILES['sliderlist'])){
                    Yii::import('common.extensions.FileUpload.UploadAction');
                    $upload = new UploadAction('im/default', NULL);
                    $upload->prefixOrigin = 'leader-';
                    $upload->prefixResized = 'resized-leader-';
                    $images = $upload->run();
                    $model->setImages($images);
                    }
                    
                    $model->SaveIndexManager();
                    $this->redirect(array('index'));
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