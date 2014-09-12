<?php

class DefaultController extends EMController
{
    public $layout='//layouts/column2';
    public $defaultAction = 'index';
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
     
    public function accessRules() {
            Yii::import('common.modules.user.UserModule');
            return array(
                array(
                    'allow',
                    'users'=>UserModule::UAC(array('superadmin','admin')),
                ),
                array(
                    'deny',
                    'users'=>array('*'),
                ),
            );
        }
}