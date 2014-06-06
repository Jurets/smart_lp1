<?php
/**
 *
 * SiteController class
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class SiteController extends EController
{
    public $layout='//layouts/main';
    
	public function actionIndex()
	{
            $model = new Indexmanager;
            $model->LoadIndexManager();
            //var_dump($model);die;
		$this->render('index', array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
    
    /**
    * Регистрация в системе
    */
    /*public function actionRegister() {
        $this->layout = '//layouts/cabinet';
        $this->render('register');
    }*/
    
    public function actionUsrcontour(){
        $this->renderPartial('_usrcontour');
    }
}