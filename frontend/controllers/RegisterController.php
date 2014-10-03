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
class RegisterController extends EMController
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
    public function actionIndex($user = '') {

        if(!Yii::app()->user->isGuest){
            throw New CHttpException(404, BaseModule::t('rec', 'Leave the account and re-register '));
        }

        if (empty($user)) {  //если юзер не задан
            if ($superrefer = Participant::model()->findByPk(Requisites::superReferId())) { //получить из реквизитов ид супер-рефера
                $user = $superrefer->username;
                $this->redirect(Yii::app()->createAbsoluteUrl('register/'.$user));
            } else
                throw New CHttpException(404, BaseModule::t('rec', 'Registration is allowed only with a personal referral page'));
        }
        if (!$inviter = Participant::model()->with('inviteCount')->findByAttributes(array('username'=>$user))) {
            throw New CHttpException(404, BaseModule::t('rec', 'Referral with the same name can not be found') . ' ' . $user);
        }
        
        $participant = New Participant('register');

        if (isset($_POST['Participant'])) {
            $participant->attributes = $_POST['Participant'];
            //ставим ид пригласившего
            $participant->inviter_id = $inviter->id;
            //определяем кто рефер в зависимости от номера приглашения
            if ($inviter->inviteCount == 1 && isset($inviter->referal)) { //если это второй приглашённый
                $referal = $inviter->referal; //то перекинуть участника на реферала реферала (дедушку)
            } else { //иначе
                $referal = $inviter; //рефер - это пригласивший
            }
            //поставить ИД реферала
            $participant->refer_id = $referal->id;
            //поставить номер в списке приглашенных
            $participant->invite_num = $inviter->inviteCount + 1;
            
            //сгенерить временный ключ
            $participant->activkey = Yii::app()->getModule('user')->encrypting(microtime() . $participant->password);
            //Начало обработки, валидация
            if ($participant->validate()) {
                /* Работа с аватаром */
                if ($_FILES['Participant']['name']!=='') {
                    // путь для сохранения файла
                    $path = Yii::app()->params['upload.path'];
                    Yii::import('common.extensions.FileUpload.UploadAction');
                    $upload = new UploadAction('im/default', NULL);
                    $upload->path_to_file = $path;
                    $upload->resize = array('width' => 250, 'height' => 175);
                    $upload->re_org = array('width' => 67, 'height' => 67);
                    $upload->prefixOrigin = 'settings-';
                    $upload->prefixResized = 'avatar-settings-';
                    $images = $upload->run();

                    if (isset($images['photo']['name'])) {
                        $participant->photo = $images['photo']['name'];
                    } else {
                        $participant->photo = '';
                    }
                } else {
                    $participant->photo = '';
                }
                $lang = Yii::app()->getRequest()->getPost('language');
                if(!empty($lang)){
                    $participant->sys_lang = $lang;
                }
                
                //пароль пока не хэшируем (захешируется позже при активации)
                if ($participant->save(false)) {
                    //отсылка почты для подтверждения регистрации
                    EmailHelper::send(array($participant->email), BaseModule::t('rec', 'Confirmation of registration'), 'regconfirm', array('participant' => $participant));
                }
                $this->render('confirmsended', array('step' => 1));
                Yii::app()->end();
            }
        }

        if(isset(Requisites::getInstance(Yii::app()->language)['details']))
        {
            $details = Requisites::getInstance(Yii::app()->language)['details'];

        }else $details = '';
        
        $sql = 'SELECT * FROM languages';
        $connection=Yii::app()->db; 
        $command=$connection->createCommand($sql);
        $languages=$command->queryAll(); 

        $this->render('register', array(
            'participant'=>$participant,
            'details'=>$details,
            'step'=>1,
            'languages' => $languages
        ));
    }
    
    /**
    * подтверждение регистрации
    * (сюда попадаем после 1 шага регистрации со ссылки в письме-подтверждении)
    */
    public function actionActivate() {
        //$email = $_GET['email'];
        if (isset($_GET['activkey'])) {
            $activkey = $_GET['activkey'];  //найти участника по коду активации (с рефером и пригласившим)
            $participant = Participant::model()->with(array(
                'referal'=>array('alias'=>'referal'),
                'inviter'=>array('alias'=>'inviter'),
            ))->findByAttributes(array('activkey'=>$activkey));
            if (!isset($participant)) {
                throw New CHttpException(404, BaseModule::t('rec', 'Unable to confirm your registration! The activation code is not found. Contact the site administrator'));
            }
            
            if (empty($participant->purse)) {//если пустой кошелёк
                $urlNext = $this->createAbsoluteUrl('activate', array('activkey'=>$participant->activkey));
                //если пустой пароль
                if (empty($participant->password)) { 
                    $this->step = 1;
                    $participant->generatePassword(); //генерация пароля
                    $this->render('confirmed', array('step'=>1, 'urlNext'=>$urlNext));
                } else {
                    if (isset($_POST['regpurse'])) {//DebugBreak();
                        // запросим проверку формата кошелька у perfectMoney
                        $userPurseTest = new PerfectMoney;
                        $userPurseTest->setScenario('purseTest');
                        $userPurseTest->payerAccount = $_POST['Participant']['purse'];
                        if($userPurseTest->validate()){
                          $participant->setScenario('setpurse');
                          $participant->attributes = $_POST['Participant'];
                          if ($participant->save(true, array('purse'))) {
                              $this->step = 3;
                              $this->render('firstpay', array('participant'=>$participant));
                              Yii::app()->end();
                          }
                        }else{
                            $error = $userPurseTest->getError('paymentTransactionStatus');
                            $participant->addError('purse', $error);
                        }
                    }
                    $this->step = 2;
                    $this->render('regpurse', array('participant'=>$participant));
                }
            } else  
            //если аккаунт не активен ЗАПУСКАЕМ ОПЛАТУ 20$
            if (!$participant->status) {
                if (isset($_POST['pay'])) {//DebugBreak();     //если пришёл ПОСТ с нажатой кнопкой "оплатить 20", то
                    $participant->setScenario('register');
                    $participant->attributes = $_POST['Participant'];
                    //если не совпал код активации из формы с кодом из базы - выкинуть ошибку
                    if ($participant->activkey != $participant->postedActivKey) {
                        throw New CHttpException(405, BaseModule::t('rec', 'Can not log in! Activation code is not valid. Contact the site administrator'));
                    }
                    $account = $_POST['account'];   //PM-аккаунт  //'u66666';   //тестовый хардкод
                    $password = $_POST['password']; //PM-пароль   //'123456';  //тестовый хардкод
                    if(MPlan::payRegistration($participant, $account, $password)){    //--- ОПЛАТА регистрации
                        $this->step = 4;
                        $this->render('secondpay', array('participant'=>$participant)); //и вывести форму оплаты 50$
                        Yii::app()->end();
                    }
                }
                $this->step = 3;                  //вывести форму оплаты 20$
                $this->render('firstpay', array('participant'=>$participant));
            } else 
            //если статус "оплачен 20$"
            if ($participant->tariff_id == Participant::TARIFF_20) {  
                if (isset($_POST['pay'])) {//DebugBreak();   //если пришёл ПОСТ с нажатой кнопкой "оплатить 50", то
                    $participant->setScenario('register');
                    $participant->attributes = $_POST['Participant'];
                    //если не совпал код активации из формы с кодом из базы - выкинуть ошибку
                    if ($participant->activkey != $participant->postedActivKey) {
                        throw New CHttpException(405, BaseModule::t('rec', 'Can not log in! Activation code is not valid. Contact the site administrator'));
                    }
                    $account = $_POST['account'];   //PM-аккаунт
                    $password = $_POST['password']; //PM-пароль
                    if (MPlan::payParticipation($participant, $account, $password)) {  //--- ОПЛАТА бизнес-участия
                        Yii::app()->user->setFlash('success', BaseModule::t('rec', 'Your payment was successful') . '!');
                        $this->step = 4;
                        $this->render('finish', array('participant'=>$participant));
                        Yii::app()->end();
                    }
                }
                $this->step = 4;
                $this->render('secondpay', array('participant'=>$participant));
            } else  
            //Если уже есть статус 50$
            if ($participant->tariff_id == Participant::TARIFF_50) {
                if (isset($_POST['login'])) {
                    $participant->setScenario('register');
                    $participant->attributes = $_POST['Participant'];
                    //если не совпал код активации из формы с кодом из базы - выкинуть ошибку
                    if ($participant->activkey != $participant->postedActivKey) {
                        throw New CHttpException(405, BaseModule::t('rec', 'Can not log in! Activation code is not valid. Contact the site administrator'));
                    }
                    
                    $participant->activkey = null;      //убираем ключ активации (он больше не нужен)
                    $participant->save(false, array('activkey')); //сохраняем модель
                    //осуществляем вход
                    $userlogin = New UserLogin();//DebugBreak();                   
                    $userlogin->username = $participant->email;     //авторизация по емейлу!
                    $userlogin->password = Yii::app()->user->getState('pw_original');//$password;
                    //!!!здесь надо отослать пароль по почте (??????)
                    ///////EmailHelper::send(array($participant->email), 'Активация в системе', 'businessstart', array('participant'=>$participant));
                    //авторизация
                    $userlogin->authenticate(null, null);
                    if (empty($userlogin->errors)) {              //если авторизация успешна -
                        $this->redirect(Yii::app()->createAbsoluteUrl('office/settings'));                  //редирект на офис
                    } else {
                        throw New CHttpException(405, BaseModule::t('rec', 'Can not log in! Activation code is not valid. Contact the site administrator'));
                    }
                }
                $this->step = 4;
                $this->render('finish', array('participant'=>$participant));
            }
        }
    }
    
}