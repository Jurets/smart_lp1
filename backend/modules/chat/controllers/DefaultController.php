<?php

class DefaultController extends EMController
{
	public $defaultAction = 'search';
    
    private $mode = 'view';
    
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Chatmessage('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Chatmessage'])) {
            $model->attributes = $_GET['Chatmessage'];
        }
        //$user = Users::model()->find(107);
        //$model2 = Chatmessage::model()->find();
        $this->render('admin',array(
            'model'=>$model,
            //'user'=>$user,
            //'model2'=>$model2,
        ));
    }

    /**
     * Поиск юзера по нику (личному домену)
     */
    public function actionSearch()
    {
        $model = new User;
        if (isset($_GET['User'])) {
            if ($user = User::model()->findByAttributes(array('username'=>$_GET['User']['username']))) {
                $this->redirect(array('chatban','id'=>$user->id));
            } else {
                $model->addError('username', BaseModule::t('dic', 'The User hasn\'t been found'));
            }
        }
        $this->render('search',array(
            'model'=>$model,
        ));
    }

    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionChatban($id)
	{
        if (!$user = Participant::model()->findByPk($id)) {
            throw new CHttpException(404, BaseModule::t('dic', 'The User hasn\'t been found'));
        }
        if (!$chatban = $user->chatban) {
            $chatban = New Chatban();
        }
        if (isset($_POST['Chatban'])) {
            if (isset($_POST['submit_ban'])) {
                $this->mode = 'ban';
            } else if (isset($_POST['submit_unban'])) {
                $this->mode = 'unban';
            }
            if ($this->mode == 'ban') {
                $chatban->attributes = $_POST['Chatban'];
                $chatban->user_id = $user->id;
                $chatban->active = Chatban::STATUS_ACTIVE;
            } else if ($this->mode == 'unban') {
                $chatban->active = Chatban::STATUS_NONACTIVE;
            } else
                throw new CHttpException(404, BaseModule::t('dic', 'An error occurred while blocking user'));
            //проверка    
            if ($chatban->validate()) {
                if ($chatban->save()) {
                    $message = $this->mode == 'ban' ?  BaseModule::t('dic', 'Participant successfully blocked in chat') : BaseModule::t('dic', 'The participant is successfully unlocked');
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS, $message);
                    //$this->redirect(Yii::app()->createUrl('user/admin/view', array('id'=>$id)));
                } else 
                    throw new CHttpException(404, BaseModule::t('dic', 'An error occurred while blocking user'));
            }
        }
        if ($this->mode == 'unban') {
            $this->redirect(array('search'));
        } else {
            $this->render('chatban',array(
                'user'=>$user,
                'chatban'=>$chatban,
            ));
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Chatmessage();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Chatmessage']))
		{
			$model->attributes=$_POST['Chatmessage'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Chatmessage']))
		{
			$model->attributes=$_POST['Chatmessage'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PaymentSystems the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Chatmessage::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PaymentSystems $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-systems-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
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
}
