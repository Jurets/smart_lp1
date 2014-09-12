<?php

class DefaultController extends EMController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

    public $modelClass = 'Faq';
    
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
//		$this->render('view',array(
//			'model'=>$this->loadModel($id),
//		));
            $this->actionIndex();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionCreate()
	{
		$model = new Faq;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Faq'])) {
			$model->attributes=$_POST['Faq'];
            if($_POST['Faq']['created']!= '') {
                //Converting "Creation time when FAQ was made" into MySQL format data https://dev.mysql.com/doc/refman/5.0/en/datetime.html
                $str = str_replace('.', '-',$model->created);
                $year = substr($str, 6, 4).'-';
                $day = substr($str, 0, 2);
                $month = substr($str, 3, 3);
                $time = substr($str, 10);
                $model->created = $year.$month.$day.$time;
            } else {
                //MySQL format DATETIME
                $today = date("Y-m-d H:i:s");
                $model->created = $today;
            }
            $model->lng = Yii::app()->language;
			if($model->save())
				$this->redirect('index');
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
	{DebugBreak();
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Faq'])) {
			$model->attributes=$_POST['Faq'];
			if ($model->saveDependLanguage())
                $this->redirect (array('index'));
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
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

        $model = new Faq('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Faq']))
			$model->attributes = $_GET['Faq'];

        $modelEmail = new Faqm;
        $modelEmail->LoadFaqManager(); // запрос к itemsstorage по параметру FAQ_MANAGER
        if(isset($_POST['Faqm'])){
            $modelEmail->attributes = $_POST['Faqm'];
            $modelEmail->SaveFaqManager();
            $this->redirect(array('index'));
        }
        $this->render('index', array('model'=>$model,'modelEmail'=>$modelEmail));
	}

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{
//			$dataProvider=new CActiveDataProvider('Faq');
//		$this->render('admin',array(
//			'dataProvider'=>$dataProvider,
//		));
            $this->actionIndex();
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Faq the loaded model
	 * @throws CHttpException
	 */
	/*public function loadModel($id)
	{
		$model=Faq::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}*/

	/**
	 * Performs the AJAX validation.
	 * @param Faq $model the model to be validated
	 */
	/*protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='faq-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}*/

    //TODO: bun for user
    //test comment
    public function actionBan()
    {

    }

}
