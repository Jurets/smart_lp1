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
            $this->render('index', array('model'=>$model, 'locale_list'=>$model->localeList()));
	}
        public function actionAddLanguage(){
            if(Yii::app()->request->isAjaxRequest){
                $model = new LanguageInterphace();
                $model->addLanguage();
                $model->renderLanguages();
                $model->showTranslation();
                $model->prepareTranslation();
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
                Yii::app()->request->cookies['language'] = new CHttpCookie('language', $model->lang);
                $this->renderPartial('_form_partial', array('model'=>$model),FALSE,TRUE);
            }
        }
        public function actionCreateTranslation(){
            $model = new LanguageInterphace();
            $model->showTranslation();
            $model->createTranslation();           
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
    public function actionSetLang($lang){
        Yii::app()->request->cookies['language'] = new CHttpCookie('language', $lang);
    }
    public function actionTest(){ // это временный метод по добавлению служебного контента, который появляется на стадии доработки проекта.
        LangDefaultInstall::readMatrixFromFile();
    }
}