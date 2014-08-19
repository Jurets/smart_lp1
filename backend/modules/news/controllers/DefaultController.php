<?php

class DefaultController extends EMController
{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	public function accessRules() {
            Yii::import('common.modules.user.UserModule');
            return array(
                array(
                    'allow',
                    'users'=>UserModule::UAC(array('superadmin', 'admin', 'moderator')),
                ),
                array(
                    'deny',
                    'users'=>array('*'),
                ),
            );
        }

    /**
    * перечень внешних действий
    * 
    */
    public function actions() {
        return array(
            'upload'=>array(
                'class'=>'common.extensions.FileUpload.UploadAction',
                'prefixOrigin'=>'news-',
                'prefixResized'=>'resized-news-',
                'uploadDir'=>$this->module->uploadDir,
                'uploadUrl'=>$this->module->uploadUrl,
            ),            
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
			$model->attributes=$_POST['News'];
                        if($model->getAttribute('activated') == false)
                            $model->setAttribute ('activated', date('H:i:s d-m-Y', time()));
                            $model->setAttribute ('created', date('H:i:s d-m-Y', time()));
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->id));
                                $this->redirect(array('admin'));
			}else
				$model->callAfterFind();
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
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
				//$this->redirect(array('view','id'=>$model->id));
                                $this->redirect(array('admin'));
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
                $this->redirect(array('admin'));
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
