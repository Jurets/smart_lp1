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
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (Yii::app()->getBaseUrl()."/index.php" === Yii::app()->user->returnUrl)
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
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
    
    public function actionKeyGenerator(){
        if(Yii::app()->request->isAjaxRequest){
            $success = true;
            $error = '';
            //валидация имейла
            $model = new User();
            if(isset($_POST['email'])) $model->email = $_POST['email'];
            $success &= $model->validate(array('email'));
            
            if($success){
                $success &= $this->sendMail($model->email);  //послать письмо
                $success ? null : $error[] = 'Ошибка при отправке почты.';
            }else{
                $error = $model->errors['email'];  //записать ошибки
            }
            echo CJSON::encode(array('success'=>$success, 'errorArr'=>$error));
        }
    }
    
    public function sendMail($email){
        $headers="From: {$email}\r\nReply-To: {$email}";
        Yii::app()->user->setState('activationCode', substr(time(),-8));
        return mail($email,'Код активации','Ваш код активации: '.Yii::app()->user->getState('activationCode'),$headers);
    }
}