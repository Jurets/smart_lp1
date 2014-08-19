<?php

class DefaultController extends EMController
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
                $model = new Faqm;
                $model->LoadFaqManager(); // запрос к itemsstorage по параметру FAQ_MANAGER
                if(isset($_POST['Faqm'])){
                    $model->attributes = $_POST['Faqm'];
                    $model->SaveFaqManager();
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