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
 * 
 * var Participant @participant 
 * 
 */
class RegisterController extends EController
{
    public $layout='//layouts/register';
    
    public $step = 1; //№ шага регистрации
    
    
      /**
    * Добавлить действие для капчи
    */
    public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'testLimit'=>0,    //делаем неограниченное кол-во попыток ввода капчи
            ),
        );
    }
    /**
    * Регистрация в системе
    */
    public function actionIndex() {//DebugBreak();
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
                }
                //$this->redirect(array('view','id'=>$model->id));
                $this->render('confirmsended', array('step'=>1));
                Yii::app()->end();
            }
        }
        
        //DebugBreak();
        //$rulesAgree = Yii::app()->user->getState('rulesAgree');
        //if (isset($rulesAgree)) 
        {
            $this->render('register', array(
                'participant'=>$participant,
                'step'=>1,
            ));
        } //else {
         //   $this->render('rulesagree', array(
         //       'participant'=>$participant,
         //   ));
        //}
    }
    
    /**
    * подтверждение регистрации
    * (сюда попадаем после 1 шага регистрации со ссылки в письме-подтверждении)
    */
    public function actionActivate() {
        //$email = $_GET['email'];
        if (isset($_GET['activkey'])) {
            $activkey = $_GET['activkey'];  //найти участника по коду активации
            $participant = Participant::model()->/*setScenario('activate')->*/findByAttributes(array('activkey'=>$activkey));
            if (!isset($participant)) {
                throw New CHttpException(404, 'Не удается подвердить регистрацию! Код активации не найден. Обратитесь к администратору сайта');
            }
            //DebugBreak();
            
            if (empty($participant->purse)) {//если пустой кошелёк
                $urlNext = $this->createAbsoluteUrl('activate', array('activkey'=>$participant->activkey));
                //если пустой пароль
                if (empty($participant->password)) { 
                    $this->step = 1;
                    $participant->generatePassword(); //генерация пароля
                    $this->render('confirmed', array('step'=>1, 'urlNext'=>$urlNext));
                } else {
                    if (isset($_POST['regpurse'])) {//DebugBreak();
                        $participant->setScenario('setpurse');
                        $participant->attributes = $_POST['Participant'];
                        if ($participant->save(true, array('purse'))) {
                            $this->step = 3;
                            $this->render('firstpay', array('participant'=>$participant));
                            Yii::app()->end();
                        }
                    }
                    $this->step = 2;
                    $this->render('regpurse', array('participant'=>$participant));
                }
            } else if (!$participant->status) { //если аккаунт не активен
                if (isset($_POST['pay'])) {     //если пришёл ПОСТ "оплатить 20"
                    $participant->activateStart(); //активировать
                    EmailHelper::send(array($participant->email), 'Активация в системе', 'activation', array('participant'=>$participant));
                    $this->step = 4;               //и вывести форму оплаты 50$
                    $this->render('secondpay', array('participant'=>$participant));
                    Yii::app()->end();
                }
                $this->step = 3;                  //вывести форму оплаты 20$
                $this->render('firstpay', array('participant'=>$participant));
            } /*else if ($participant->tariff_id == Participant::TARIFF_START) {
                $this->step = 3;
                $this->render('firstpay', array('participant'=>$participant));
            }*/ else if ($participant->tariff_id == Participant::TARIFF_20) {
                if (isset($_POST['pay'])/* && isset($_POST['Participant']['tariff_id']) && $_POST['Participant']['tariff_id'] == */) {
                    $participant->attributes = $_POST['Participant'];
                    $participant->activateBuisness();  //стать бизнес-участником
                    EmailHelper::send(array($participant->email), 'Активация в системе', 'businessstart', array('participant'=>$participant));
                    $this->step = 4;
                    $this->render('finish', array('participant'=>$participant));
                    Yii::app()->end();
                }
                $this->step = 4;
                $this->render('secondpay', array('participant'=>$participant));
            } else  if ($participant->tariff_id == Participant::TARIFF_50) {//DebugBreak();
                if (isset($_POST['login'])) {
                    $participant->setScenario('register');
                    $participant->attributes = $_POST['Participant'];
                    if ($participant->activkey == $participant->postedActivKey) { //если совпал код активации из формы с кодом из базы
                        $password = $participant->password; //сохраняем исходный пароль
                        //вначале хэширем пароль и сохраняем его в базе
                        $participant->password = Yii::app()->getModule('user')->encrypting($participant->password);
                        $participant->activkey = null;
                        $participant->save(false, array('password', 'activkey'));
                        //осуществляем вход
                        $userlogin = New UserLogin();                   
                        $userlogin->username = $participant->email;     //авторизация по емейлу!
                        $userlogin->password = $password;
                        //!!!здесь надо отослать пароль по почте 
                        //EmailHelper::send(array($participant->email), 'Активация в системе', 'businessstart', array('participant'=>$participant));
                        //авторизация
                        $userlogin->authenticate(null, null);
                        if (empty($userlogin->errors)) {              //если авторизация успешна -
                            $this->redirect(Yii::app()->createAbsoluteUrl('office'));                  //редирект на офис
                        } else {
                            throw New CHttpException(405, 'Не удается авторизоваться! Обратитесь к администратору сайта');
                        }
                    } else {
                        throw New CHttpException(405, 'Не удается авторизоваться! Код активации не правильный. Обратитесь к администратору сайта');
                    }
                }
                $this->step = 4;
                $this->render('finish', array('participant'=>$participant));
            }
        }
        
    }
}