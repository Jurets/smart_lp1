<?php

class LoginController extends EController
{
	public $defaultAction = 'login';


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
            $this->performAjaxValidation($model);
			// collect user input data
			if(isset($_POST['UserLogin'])) {
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
                    $model->clearLoginCode();
					if (Yii::app()->getBaseUrl()."/index.php" === Yii::app()->user->returnUrl)
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						//$this->redirect(Yii::app()->user->returnUrl);
                        $this->redirect(Yii::app()->createAbsoluteUrl('invitation'));
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	protected function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit_at = date('Y-m-d H:i:s');
		$lastVisit->save();
	}
    
//    public function filters() {
//        return array(
//            'accessControl',
//        );
//    }
// 
//    public function accessRules() {
//        return array(
//            // если используется проверка прав, не забывайте разрешить доступ к
//            // действию, отвечающему за генерацию изображения
//            array('allow',
//                'actions'=>array('captcha'),
//                'users'=>array('*'),
//            ),
//            array('deny',
//                'users'=>array('*'),
//            ),
//        );
//    }
// 
    public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
            ),
        );
    }
    
    /**
    * генерация кода логина для юзера
    * 
    */
    public function actionKeyGenerator(){
        if(Yii::app()->request->isAjaxRequest && isset($_POST['UserLogin'])){
            $model = new UserLogin;
            $model->attributes=$_POST['UserLogin']; 
            // validate user input and redirect to previous page if valid
            if ($success = $model->validate(array('username', 'password'))) {
                $user = $model->identity->user; //запомнить юзера
                Yii::app()->user->logout();   //выход юзера, т.к. пока только проверка
                if (!$success = $this->sendCodeToMail($user)) {
                    $model->addErrors('Ошибка при отправке почты');
                }
            }
            echo CJSON::encode(array('success'=>$success, 'errorArr'=>$model->errors));
        }
    }
    
    /**
    * отсылка кода логина на почту юзеру
    * 
    * @param mixed $user
    */
    private function sendCodeToMail($user){
        $email = $user->email;
        $logincode = substr(time(),-8); //генерить случайный код (для входа)
        $headers = "From: {$email}\r\nReply-To: {$email}";
        if ($success = mail($email, 'Код для входа', 'Ваш код для входа: '.$logincode, $headers)) {
            //Yii::app()->user->setState('activationCode', $code);
            //записать код входа в базу
            Yii::app()->db->createCommand()->update(Yii::app()->getModule('user')->tableUsers, array('logincode'=>$logincode), 'id=:id', array(':id'=>$user->id));
        }
        return $success;
    }
    
}