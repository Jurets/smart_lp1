<?php

class DefaultController extends EMController
{
     public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
    
	public function actionIndex()
	{
            $model = new LanguageInterphace();
                $model->addLanguage();
                $model->renderLanguages();
            $this->render('index', array('model'=>$model));
	}
        public function actionAddLanguage(){
            if(Yii::app()->request->isAjaxRequest){
                $model = new LanguageInterphace();
                $model->addLanguage();
                $model->renderLanguages();
                $this->renderPartial('_lang_list', array('model'=>$model),FALSE,TRUE);
            }
        }
        public function actionDeleteLanguage(){
            if(Yii::app()->request->isAjaxRequest){
                $model = new LanguageInterphace();
                $model->deleteLanguage();
                $model->renderLanguages();
                $this->renderPartial('_lang_list', array('model'=>$model),FALSE,TRUE);
            }
        }
        public function actionShowTranslation(){
            if(Yii::app()->request->isAjaxRequest){
                $model = new LanguageInterphace();
                $model->showTranslation();
                $this->renderPartial('_form_partial', array('model'=>$model),FALSE,TRUE);
            }
        }
        public function actionCreateTranslation(){
            $model = new LanguageInterphace();
            $model->createTranslation();
            //$model->showTranslation();
            //$this->renderPartial('_form_partial', array('model'=>$model),FALSE,TRUE);
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