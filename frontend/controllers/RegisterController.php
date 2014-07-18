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
    public function actionIndex($user = '') {
        if (empty($user)) {
            throw New CHttpException(404, "Регистрация разрешена только с личной страницы реферала");
        } else if (!$inviter = Participant::model()->with('inviteCount')->findByAttributes(array('username'=>$user))) {
            throw New CHttpException(404, "Не найден реферал с именем $user");
        }
        
        $participant = New Participant('register');
        
        if(isset($_POST['Participant'])) {
            $participant->attributes = $_POST['Participant'];
            //ставим ид пригласившего
            $participant->inviter_id = $inviter->id;                 
            //определяем кто рефер в зависимости от номера приглашения
            if ($inviter->inviteCount == 1 && isset($inviter->referal)) {  //если это второй приглашённый
                $referal = $inviter->referal;    //то перекинуть участника на реферала реферала (дедушку)
            } else {                             //иначе
                $referal = $inviter;               //рефер - это пригласивший
            }
            //поставить ИД реферала
            $participant->refer_id = $referal->id;                  
            //поставить номер в списке приглашенных
            $participant->invite_num = $inviter->inviteCount + 1;
            
            //сгенерить временный ключ
            $participant->activkey = Yii::app()->getModule('user')->encrypting(microtime().$participant->password);

            /* Работа с аватаром */
            if (isset($_FILES['photo'])) {
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
                $tmp =1;
                $participant->photo = $images[0]['name'];

            } else {
                $participant->photo = '';
            }
            //Начало обработки, валидация
            if($participant->validate()) {//DebugBreak();
                //пароль пока не хэшируем (захешируется позже при активации)
                if ($participant->save()) {
                    //отсылка почты для подтверждения регистрации
                    EmailHelper::send(array($participant->email), 'Подтверждение регистрации', 'regconfirm', array('participant'=>$participant));
                }
                $this->render('confirmsended', array('step'=>1));
                Yii::app()->end();
            }
        }
        $this->render('register', array(
            'participant'=>$participant,
            'step'=>1,
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
                throw New CHttpException(404, 'Не удается подвердить регистрацию! Код активации не найден. Обратитесь к администратору сайта');
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
            } else  
            //если аккаунт не активен ЗАПУСКАЕМ ОПЛАТУ 20$
            if (!$participant->status) { 
                if (isset($_POST['pay'])) {//DebugBreak();     //если пришёл ПОСТ с нажатой кнопкой "оплатить 20", то
                    $participant->setScenario('register');
                    $participant->attributes = $_POST['Participant'];
                    //если не совпал код активации из формы с кодом из базы - выкинуть ошибку
                    if ($participant->activkey != $participant->postedActivKey) {
                        throw New CHttpException(405, 'Не удается авторизоваться! Код активации не правильный. Обратитесь к администратору сайта');
                    }
                    
                    $pm = new PerfectMoney();              //Попытаться сделать платёж
                    /* обязательные параметры */
                    $pm->login = '6416431';                //временно хардкод
                    $pm->password = 'uhaha322re423e';      //временно хардкод
                    $pm->payerAccount = $participant->purse;//'U6840713';
                    $pm->payeeAccount = Requisites::purseActivation(); //'U3627324';  //поставить кошелёк активаций системы!!!!!!!!!!!
                    $pm->amount = Tariff::getTariffAmount(Participant::TARIFF_20);
                    /* необязательные параметры */
                    $pm->payerId = $participant->id;
                    $pm->payeeId = null;
                    $pm->transactionId = 1; // установка номера tr_kind_id вручную. При наличии этого параметра  использование transactionKind бессмысленно.
                    $pm->notation = 'Регистрация в системе';
                    $pm->Run('confirm');    //запуск процесса платежа в PerfectMoney

                    if (!$pm->hasErrors()) {//DebugBreak();  //если успешно - 
                        $pw_original = $participant->password; //сохраняем исходный пароль, чтобы нехэшированным отослать его в письме
                        Yii::app()->user->setState('pw_original', $pw_original);
                        $participant->activateStart(); //активировать (там же хэш пароля и стереть активкод)
                        Requisites::depositActivation($pm->amount); //увеличить баланс кошелька активаций 
                        EmailHelper::send(array($participant->email), 'Активация в системе', 'activation', array('participant'=>$participant, 'pw_original'=>$pw_original)); //отослать емейл
                        $this->step = 4;               
                        $this->render('secondpay', array('participant'=>$participant)); //и вывести форму оплаты 50$
                        Yii::app()->end();
                    } else {
                        $participant->addError('tariff_id', $pm->getError('paymentTransactionStatus'));
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
                        throw New CHttpException(405, 'Не удается авторизоваться! Код активации не правильный. Обратитесь к администратору сайта');
                    }

                    $pm = new PerfectMoney();              //Попытаться сделать платёж
                    /* обязательные параметры */
                    $pm->login = '6416431';                //временно хардкод
                    $pm->password = 'uhaha322re423e';      //временно хардкод
                    $pm->payerAccount = $participant->purse;//'U6840713';
                    //определить - на какой кошелёк пойдёт оплата
                    if ($participant->invite_num == 3 || $participant->invite_num == 4) {  //если третий или четвёртый,
                        $pm->payeeAccount = Requisites::purseClub(); //'U3627324';  //поставить кошелёк активаций системы!!!!!!!!!!!
                        $pm->payeeId = null;
                    } else {
                        $pm->payeeAccount = $participant->referal->purse;    //   то платёж на кошелёк данного реферала
                        $pm->payeeId = $participant->referal->id;
                    }
                    
                    //поставить сумму платежа
                    $pm->amount = Tariff::getTariffAmount(Participant::TARIFF_50); //'50.00';   
                    /* необязательные параметры */
                    $pm->payerId = $participant->id;
                    $pm->transactionId = 2; // установка номера tr_kind_id вручную. При наличии этого параметра  использование transactionKind бессмысленно.
                    $pm->notation = 'Вступление в бизнес-клуб';
                    $pm->Run('confirm');    //запуск процесса платежа в PerfectMoney

                    if (!$pm->hasErrors()) {  //если успешно -
                        //$participant->attributes = $_POST['Participant'];
                        //стать бизнес-участником
                        $participant->activateParticipation();
                        //перевести взнос на нужный кошелёк
                        if ($participant->invite_num == 3 || $participant->invite_num == 4)  {  //если приглашённый 3 или 4
                            Requisites::depositClub($pm->amount);                //увеличить баланс кошелька клуба
                            if ($participant->invite_num == 4) {                 //если это четвёртый приглашённый
                                $participant->referal->activateBusiness();         //активировать Бизнес-клуб у реферала
                            }
                        } else {                                                 //иначе
                            $participant->referal->depositPurse($pm->amount);     //кинуть сумму в кошелёк рефера (папа или дедушка)
                        }
                        //отослать письмо про вступление в бизнес-участие
                        EmailHelper::send(array($participant->email), 'Вы стали бизнес-участником', 'businessstart', array('participant'=>$participant));
                        $this->step = 4;
                        $this->render('finish', array('participant'=>$participant));
                        Yii::app()->end();
                    } else {
                        $participant->addError('tariff_id', $pm->getError('paymentTransactionStatus'));
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
                        throw New CHttpException(405, 'Не удается авторизоваться! Код активации не правильный. Обратитесь к администратору сайта');
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
                        throw New CHttpException(405, 'Не удается авторизоваться! Обратитесь к администратору сайта');
                    }
                }
                $this->step = 4;
                $this->render('finish', array('participant'=>$participant));
            }
        }
    }
    
}