<?php

class NewsController extends EController
{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $path;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
 			array('allow',  // allow all users to perform 'index' and 'view' actions
 				'actions'=>array('index','view', 'create', 'update', 'delete', 'upload'),
 				'users'=>array('*'),
 			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'admin', 'delete', 'index', 'view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
// 			array('deny',  // deny all users
// 				'users'=>array('*'),
// 			),
		);
	}

	/*
	 * addition methods and fields - temporary destinated here
	 * if ok it returns natty file name (for example to model-implementation)
	 * */
	
// 	private function getNattyFileUploadPath($instance){
// 		if(! $instance instanceof CUploadedFile){
// 			return -1;
// 		}
// 		$ext = '.' . substr($instance->type, strrpos($instance->type, '/')+1);
// 		$fileUploadPath = 'news_' . substr(md5(time()), 0, 10) . $ext;
// 		return $fileUploadPath;
// 	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	
	public function actionCreate()
	{	
		$model=new News;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			debug_backtrace();
			$model->attributes=$_POST['News'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}else
				$model->callAfterFind();
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/*
	 * Upload file action 
	 * */
	/* upploading additionaly */
	public function actionUpload()
	{
// 		require('UploadHandler.php');
// 		$options = array(
// 				'script_url' => 'http://justmoney-admin.smart/',
// 				'upload_url' => 'http://justmoney-admin.smart/files/',
// 				'upload_dir' => '/home/servbat/smart_lp1/backend/www/files/',
// 				'param_name' => 'files'
// 		);
// 		$upload_handler = new UploadHandler($options);

		;
		
		debug_backtrace();
		if ($_FILES['files']){
			$ext = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
			$filename = 'news-origin-'.substr(md5(uniqid()), 0, 8) . "." . $ext;
			//$file_path = Yii::getPathOfAlias('news.uploads').DIRECTORY_SEPARATOR.$filename;
			$file_path = Yii::app()->getBasePath() . $this->module->params['uploadPath'] . $filename;
			$result = move_uploaded_file($_FILES['files']['tmp_name'][0],  $file_path);
			//$resized = ImageHelper::makeNewsThumb(Yii::getPathOfAlias('news.uploads').DIRECTORY_SEPARATOR.$filename);
			$resized = ImageHelper::makeNewsThumb($file_path);
			//$resized = $file_path;
			//unlink($file_path);
			$json = array(
					"files"=>array(
							array(
									"name"=>$filename,
									"original"=>$resized,
									//"url"=> Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR . $filename,
									"url"=>$file_path,
							)));
		
			if ($result)
				echo json_encode($json);
			else
				echo  json_encode(array("error"=>"error"));
		}
		
		
		
		
		
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		debug_backtrace();
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			
			$model->attributes=$_POST['News'];
			//$model->illustration=CUploadedFile::getInstance($model, 'illustration');
			//if(isset($model->illustration)){
				//$this->path = $this->getNattyFileUploadPath($model->illustration);
				//unlink(Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR . $model->image);
				//$model->illustration->saveAs(Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR . $this->path);
				//$model->image = $this->path;
			//}
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
			else
				$model->callAfterFind();
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		if(is_file(Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR . $model->image))
			unlink(Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR . $model->image);
		if(is_file(Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR .'resized-'. $model->image))
			unlink(Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR . 'resized-' .$model->image);
			
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
