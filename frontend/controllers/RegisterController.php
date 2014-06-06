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
class RegisterController extends EController
{
    public $layout='//layouts/register';
    
    /**
    * Регистрация в системе
    */
    public function actionIndex() {
        //$participant = Participant::model()->findByPk();
        $participant = New Participant('register');
        //$this->performAjaxValidation(array($model));

        if(isset($_POST['Participant'])) {
            $participant->attributes = $_POST['Participant'];
            //$participant->activkey = Yii::app()->controller->module->encrypting(microtime().$participant->password);
            $participant->activkey = Yii::app()->getModule('user')->encrypting(microtime().$participant->password);
            if($participant->validate()) {//DebugBreak();
                ///////$participant->password = Yii::app()->controller->module->encrypting($participant->password);
                //$participant->password = Yii::app()->getModule('user')->encrypting($participant->password);
                if ($participant->save()) {
                    //отсылка почты для подтверждения регистрации
                    EmailHelper::send(array($participant->email), 'Подтверждение регистрации', 'regconfirm', array('participant'=>$participant));
                    //EmailHelper::send(array('jurets75@rambler.ru'), 'Подтверждение регистрации', 'regconfirm', array('participant'=>$participant));
                }
                //$this->redirect(array('view','id'=>$model->id));
                $this->render('confirmsended', array(
                    'participant'=>$participant,
                ));
                Yii::app()->end();
            }
        }
        
        //DebugBreak();
        //$rulesAgree = Yii::app()->user->getState('rulesAgree');
        //if (isset($rulesAgree)) 
        {
            $this->render('register', array(
                'participant'=>$participant,
            ));
        } //else {
         //   $this->render('rulesagree', array(
         //       'participant'=>$participant,
         //   ));
        //}
    }
    
    /**
    * подтверждение регистрации
    * 
    */
    public function actionActivate() {
        $email = $_GET['email'];
        $activkey = $_GET['activkey'];

    }
}