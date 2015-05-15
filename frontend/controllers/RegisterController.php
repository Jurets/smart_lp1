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
class RegisterController extends EMController {

    public $layout = '//layouts/register';
    public $step = 1; //№ шага регистрации

    /**
     * Добавлить действие для капчи
     */

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'testLimit' => 0, //делаем неограниченное кол-во попыток ввода капчи
            ),
        );
    }

    public function beforeAction($action) {
        parent::beforeAction($action);
        BaseModule::checkSubdomainExistence();
        return TRUE;
    }

    /**
     * Регистрация в системе
     */
    public function actionIndex($user = '') {
        if (!Yii::app()->user->isGuest) {
            throw New CHttpException(404, BaseModule::t('rec', 'Leave the account and re-register '));
        }
        $user = BaseModule::getUserFromSubdomain();
        if (empty($user)) {
            if ($superrefer = Participant::model()->findByPk(Requisites::superReferId())) { //получить из реквизитов ид супер-рефера
                $user = $superrefer->username;
                //$this->redirect(Yii::app()->createAbsoluteUrl('register/index/user/'.$user));
                $this->redirect(BaseModule::createAssembledUrl($user) . Yii::app()->createUrl('register'));
            } else
                throw New CHttpException(404, BaseModule::t('rec', 'Registration is allowed superreferer not found'));
        }
        /* проверка: если юзер не активен - то перекинем его регистрацию на его реферера либо на корневой домен */
        $testUserActive = Participant::model()->find('username = :username', [':username' => $user]);
        if (!is_null($testUserActive)) {
            if ($testUserActive->status != '1') {
                if (!is_null($testUserActive->refer_id)) {
                    $referRedirect = $testUserActive->referal->username;
                    $this->redirect(BaseModule::createAssembledUrl($referRedirect) . Yii::app()->createUrl('register'));
                } else {
                    $user = '';
                }
            }
        }
        //если юзер не задан
        if (empty($user)) {
            if ($superrefer = Participant::model()->findByPk(Requisites::superReferId())) { //получить из реквизитов ид супер-рефера
                $user = $superrefer->username;
                //$this->redirect(Yii::app()->createAbsoluteUrl('register/index/user/'.$user));
                $this->redirect(BaseModule::createAssembledUrl($user) . Yii::app()->createUrl('register'));
            } else
                throw New CHttpException(404, BaseModule::t('rec', 'Registration is allowed only with a personal referral page'));
        }
        if (!$inviter = Participant::model()->with('inviteCount')->findByAttributes(array('username' => $user))) {
            throw New CHttpException(404, BaseModule::t('rec', 'Referral with the same name can not be found') . ' ' . $user);
        }

        $participant = New Participant('register');


        if (isset($_POST['Participant'])) {
            $participant->attributes = $_POST['Participant'];
            //ставим ид пригласившего
            $participant->inviter_id = $inviter->id;
            //определяем кто рефер в зависимости от номера приглашения - здесь определять нельзя, переносится на шаг оплаты 50
            // if ($inviter->inviteCount == 1 && isset($inviter->referal)) { //если это второй приглашённый
            //     $referal = $inviter->referal; //то перекинуть участника на реферала реферала (дедушку)
            // } else { //иначе
            //     $referal = $inviter; //рефер - это пригласивший
            // }
            //поставить ИД реферала
            $referal = $inviter; // до активации считаем рефералом пригласившего
            $participant->refer_id = $referal->id;
            //поставить номер в списке приглашенных - переносится на шаг 50
            //$participant->invite_num = $inviter->inviteCount + 1;
            //сгенерить временный ключ
            $participant->activkey = Yii::app()->getModule('user')->encrypting(microtime() . $participant->password);
            //Начало обработки, валидация
            if ($participant->validate()) {
                /* Работа с аватаром */
                if ($_FILES['Participant']['name'] !== '') {
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
                if (!empty($lang)) {
                    $participant->sys_lang = $lang;
                }

                //пароль пока не хэшируем (захешируется позже при активации)
                if ($participant->save(false)) {
                    //отсылка почты для подтверждения регистрации
                    EmailHelper::sendFromAdmin(array($participant->email), BaseModule::t('rec', 'Confirmation of registration'), 'regconfirm', array('participant' => $participant));
                }
                $message = BaseModule::t('rec', 'On your mail has been sent. In the letter you will find a link Click on it.');
                $this->render('confirmsended', array(
                    'step' => 1,
                    'participant' => $participant,
                    'message' => $message,
                ));
                Yii::app()->end();
            }
        }

        if (isset(Requisites::getInstance(Yii::app()->language)['details'])) {
            $details = Requisites::getInstance(Yii::app()->language)['details'];
        } else
            $details = '';

        $sql = 'SELECT * FROM Languages';
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $languages = $command->queryAll();

        $this->render('register', array(
            'participant' => $participant,
            'details' => $details,
            'step' => 1,
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
                        'referal' => array('alias' => 'referal'),
                        'inviter' => array('alias' => 'inviter'),
                    ))->findByAttributes(array('activkey' => $activkey));
            ///  ПРОВЕРКИ!
            if (!isset($participant)) {
                throw New CHttpException(404, BaseModule::t('rec', 'Unable to confirm your registration! The activation code is not found. Contact the site administrator'));
            }
            // условие обхода основного правила при задействовании автоклуба
            if($participant->referal->autoclub == 1){$participant->invite_num = 10;}
            // TO DO добавить проверку на автоклуб - пригласивший попал в клуб без приглашения, через 250, значит приглашенный не попадает в четверку первых однозначно.
            ///// ------- Разветвлённая логика пошаговой активации
            if (empty($participant->purse)) {//если пустой кошелёк
                $urlNext = $this->createAbsoluteUrl('activate', array('activkey' => $participant->activkey));
                //если пустой пароль
                if (empty($participant->password)) {
                    $this->step = 1;
                    $participant->generatePassword(); //генерация пароля
                    $this->render('confirmed', array('step' => 1, 'urlNext' => $urlNext));
                } else {
                    if (isset($_POST['regpurse'])) {
                        // запросим проверку формата кошелька у perfectMoney
                        $userPurseTest = new PerfectMoney;
                        $userPurseTest->setScenario('purseTest');
                        $userPurseTest->payerAccount = $_POST['Participant']['purse'];
                        if ($userPurseTest->validate()) {
                            $participant->setScenario('setpurse');
                            $participant->attributes = $_POST['Participant'];
                            if ($participant->save(true, array('purse'))) {
                                $this->step = 3;
                                $amount = marketingPlanHelper::init()->getMpParam('price_activation');
                                $instruction = CHtml::tag('p', array('id' => "shag-3-1-text"), BaseModule::t('rec', 'To activate your account, you must make the participation fee of $') . ' ' . $amount);
                                $this->render('firstpay', array(
                                    'participant' => $participant,
                                    'tariff' => Participant::TARIFF_20, //флаг успешной оплаты
                                    'purse' => Requisites::purseActivation(), //кошелёк
                                    'amount' => marketingPlanHelper::init()->getMpParam('price_activation'), //сумма для активации 20$
                                    'instruction' => $instruction, // текст-инструкция
                                    'paysuccess' => false, //флаг успешной оплаты
                                    'message' => '', // и сообщение
                                ));
                                Yii::app()->end();
                            }
                        } else {
                            $error = $userPurseTest->getError('paymentTransactionStatus');
                            $participant->addError('purse', $error);
                        }
                    }
                    $this->step = 2;
                    $this->render('regpurse', array('participant' => $participant));
                }
            }

            //если аккаунт не активен ЗАПУСКАЕМ ОПЛАТУ 20$
            else if ($participant->tariff_id < Participant::TARIFF_20 /* !$participant->status */) {
                $this->step = 3;
                $tariff = Participant::TARIFF_20;
                $purse = Requisites::purseActivation();
                $amount = marketingPlanHelper::init()->getMpParam('price_activation');
                $paysuccess = false;
                $instruction = CHtml::tag('p', array('id' => "shag-3-1-text"), BaseModule::t('rec', 'To activate your account, you must make the participation fee of $') . ' ' . $amount);
                $message = '';
                //проверить: есть ли запись в БД о транзакции
                $transaction = PmTransactionLog::model()->find('from_user_id = :user_id AND tr_kind_id = :kind_id', array(
                    ':user_id' => $participant->id,
                    ':kind_id' => PmTransactionLog::TRANSACTION_REGISTRATION));
                $trans_success = isset($transaction) && !isset($transaction->tr_err_code);
                // установить сценарий "регистрация"
                $participant->setScenario('register');
                //если пришёл ПОСТ ответа от PerfectMoney:
                if (isset($_POST['PAYMENT_BATCH_NUM']) && $_POST['PAYMENT_BATCH_NUM'] <> 0) {  // пришёл ненулевой код транзакции (PAYMENT_BATCH_NUM)
                    // проведение процесса регистрации в системе
                    if (MPlan::paymentSCI($participant)) { //
                        $paysuccess = true;
                        $message = BaseModule::t('rec', 'Your payment was successful');
                    }
                }
                //если совпал код активации из формы с кодом из базы и нажали кнопку ДАЛЕЕ- перейти на следующий шаг
                else if (isset($_POST['pay'])) {
                    $participant->attributes = $_POST['Participant'];
                    //если не совпал код активации из формы с кодом из базы - выкинуть ошибку
                    if ($participant->activkey != $participant->postedActivKey) {
                        throw New CHttpException(405, BaseModule::t('rec', 'Can not log in! Activation code is not valid. Contact the site administrator'));
                    }
                    if ($trans_success) {  ///// оплату завершено УСПЕШНО!
                        // ---------- !TODO Перенести в MPlan ???
                        $pw_original = $participant->password; //сохраняем исходный пароль, чтобы нехэшированным отослать его в письме
                        Yii::app()->user->setState('pw_original', $pw_original);
                        $participant->activateStart(); //активировать (там же хэш пароля и стереть активкод)
                        Requisites::depositActivation(marketingPlanHelper::init()->getMpParam('price_activation')); //увеличить баланс кошелька активаций
                        EmailHelper::sendFromAdmin(array($participant->email), BaseModule::t('dic', 'Activation in system'), 'activation', array(
                            'participant' => $participant,
                            'pw_original' => $pw_original
                        )); //отослать емейл --------------
                        // переход ко второй оплате 50$
                        $this->step = 4;                   // увеличиваем шаг
                        $amount = marketingPlanHelper::init()->getMpParam('price_start'); //ставим сумму оплаты $50
                        $instruction = CHtml::tag('p', array('id' => "shag-4-1-text"), BaseModule::t('common', 'Congratulations! You are already logged in!') . '<br><br>' .
                                        BaseModule::t('common', 'Now, to become a party to a business, you must pass the final step.') . '<br>' .
                                        BaseModule::t('common', 'Business participation will allow you to get so many things and so many things! Do not waste time!')
                        );
                        $tariff = Participant::TARIFF_50;  // ставим тариф 50$
                        // выбрать кошелек для оплаты
                        // номер приглашенного
                        $num = $participant->inviter->inviteCount() + 1;
                        $participant->invite_num = $num;
                        // условие обхода основного правила с учетом автоклуба
                        if($participant->referal->autoclub == 1){$participant->invite_num = 10;}
                        if ($participant->invite_num == 3 || $participant->invite_num == 4) {  //если третий или четвёртый,
                            $purse = Requisites::purseClub();   //кошелёк клуба!
                        } else {
                            // дополнительное условие для корреции $purse (папа-дедушка)
                            //$inviter = $participant->referal;
                            $inviter = $participant->inviter;
                            if ($inviter->inviteCount == 1 && isset($inviter->referal)) { //если это второй приглашённый
                                $referal = $inviter->referal; //то перекинуть участника на реферала реферала (дедушку)
                            } else { //иначе
                                $referal = $inviter; //рефер - это пригласивший
                            }
                            // условие обхода основного правила с учетом автоклуба
                            if($participant->referal->autoclub == 1){$referal = $inviter;}
                            $purse = $referal->purse;    // то платёж на кошелёк данного реферала
                        }
                    }
                } else {
                    //определить - была ли оплата, делаем это по тарифу (статусу)
                    $paysuccess = $trans_success || ($participant->tariff_id >= Participant::TARIFF_20);
                    $message = $paysuccess ? BaseModule::t('rec', 'Your payment was successful') : '';
                }
                //вывести форму оплаты 20$
                $this->render('firstpay', array(
                    'participant' => $participant,
                    'tariff' => $tariff, //флаг успешной оплаты
                    'purse' => $purse, //кошелёк А
                    'amount' => $amount, //сумма для активации 20$
                    'paysuccess' => $paysuccess, //флаг успешной оплаты
                    'instruction' => $instruction, // текст-инструкция
                    'message' => $message, // и сообщение
                ));
            }

            // -------- если статус "оплачен 20$"
            else if ($participant->tariff_id == Participant::TARIFF_20) {
                $this->step = 4;
                $tariff = Participant::TARIFF_50;  // ставим тариф 50$
                // задается количество приглашенных
                $num = $participant->inviter->inviteCount() + 1;
                $participant->invite_num = $num;
                // условие обхода основного правила в случае с автоклубом
                if($participant->referal->autoclub == 1){$participant->invite_num = 10;}
                if ($participant->invite_num == 3 || $participant->invite_num == 4) {  //если третий или четвёртый,
                    $purse = Requisites::purseClub();   //кошелёк клуба!
                } else {
                    // дополнительное условие для корреции $purse (папа-дедушка)
                    //$inviter = $participant->referal;
                    $inviter = $participant->inviter;
                    if ($inviter->inviteCount == 1 && isset($inviter->referal)) { //если это второй приглашённый
                        $referal = $inviter->referal; //то перекинуть участника на реферала реферала (дедушку)
                    } else { //иначе
                        $referal = $inviter; //рефер - это пригласивший
                    }
                    // условие обхода основного правила в случае с автоклубом
                    if($participant->referal->autoclub == 1){$referal = $inviter;}
                    $purse = $referal->purse;    // то платёж на кошелёк данного реферала
                }
                //var_dump('стадия до:',$referal->id, $participant->invite_num);

                $amount = marketingPlanHelper::init()->getMpParam('price_start');
                $paysuccess = false;
                $instruction = CHtml::tag('p', array('id' => "shag-4-1-text"), BaseModule::t('common', 'Congratulations! You are already logged in!') . '<br><br>' .
                                BaseModule::t('common', 'Now, to become a party to a business, you must pass the final step.') . '<br>' .
                                BaseModule::t('common', 'Business participation will allow you to get so many things and so many things! Do not waste time!')
                );
                $message = '';
                //проверить: есть ли запись в БД о транзакции
                $transaction = PmTransactionLog::model()->find('from_user_id = :user_id AND tr_kind_id = :kind_id', array(
                    ':user_id' => $participant->id,
                    ':kind_id' => PmTransactionLog::TRANSACTION_ENTER_BC));
                $trans_success = isset($transaction) && !isset($transaction->tr_err_code);
                // установить сценарий "регистрация"
                $participant->setScenario('register');

                //если пришёл ПОСТ ответа от PerfectMoney: ненулевой код транзакции (PAYMENT_BATCH_NUM)
                if (isset($_POST['PAYMENT_BATCH_NUM']) && $_POST['PAYMENT_BATCH_NUM'] <> 0) {

                    if (MPlan::participationSCI($participant)) {  //--- ОПЛАТА бизнес-участия
                        $paysuccess = true;
                        $message = BaseModule::t('rec', 'Your payment was successful');
                    }
                }
                //если совпал код активации из формы с кодом из базы и нажали кнопку ДАЛЕЕ- перейти на следующий шаг
                else if (isset($_POST['pay'])) {
                    $participant->attributes = $_POST['Participant'];
                    //если не совпал код активации из формы с кодом из базы - выкинуть ошибку
                    if ($participant->activkey != $participant->postedActivKey) {
                        throw New CHttpException(405, BaseModule::t('rec', 'Can not log in! Activation code is not valid. Contact the site administrator'));
                    }
                    if ($trans_success) {

                        //$count = $participant->referal->inviteCount; // релейшн модифицирован - считаем только активных членов структуры
                        $count = $participant->inviter->inviteCount; // то же что и в предидущем случае но опираемся на именно приглашенных
                        $participant->invite_num = $count + 1; // сразу увеличиваем счетчик приглашенных на 1
                        // получаем $inviter
                        $inviter = $participant->inviter;

                        // патч-условие обхода основного правила если автоклуб
                        if($participant->referal->autoclub == 1){
                           $participant->invite_num = 10;
                        }

                        if ($count == 1 && isset($inviter->referal)) { //если это второй приглашённый
                            $referal = $inviter->referal; //то перекинуть участника на реферала реферала (дедушку)
                        } else { //иначе
                            $referal = $inviter; //рефер - это пригласивший
                        }
                        
                        //патч 2 дополнительное условие обхода
                        if($participant->referal->autoclub == 1){
                            $referal = $inviter;
                        }
                        
                        //var_dump('стадия 2:', $referal->id);
                        //die;
                        
                        //патч-условие обхода основного правила в случае с автоклубом
                        if($participant->referal->autoclub == 1){$participant->invite_num = 10;}
                        //перевести взнос на нужный кошелёк
                        if ($participant->invite_num == 3 || $participant->invite_num == 4) {  //если приглашённый 3 или 4
                            Requisites::depositClub($amount);                //увеличить баланс кошелька клуба
                            if ($participant->invite_num == 4) {                 //если это четвёртый приглашённый
                                // активация рефера в бизнес-клуб
                                $referal->activateBusiness();         //активировать Бизнес-клуб у реферала
                            }
                        } else {
                            // передача суммы на кошелек реферера (папа или дедушка)
                            $referal->depositPurse($amount);     //кинуть сумму в кошелёк рефера (папа или дедушка)
                        }

                        //стать бизнес-участником
                        $participant->refer_id = $referal->id;
                        $participant->activateParticipation();


                        //отослать письмо про вступление в бизнес-участие
                        EmailHelper::sendFromAdmin(array($participant->email), BaseModule::t('dic', 'You have become a business participant'), 'businessstart', array('participant' => $participant));
                        Yii::app()->user->setFlash('success', BaseModule::t('rec', 'Your payment was successful') . '!');
                        // увеличиваем шаг и рендерим вьюшку по второй оплате 50$
                        $this->step = 4;
                        // и выводится финальная форма
                        $this->render('finish', array(
                            'participant' => $participant
                        ));
                        Yii::app()->end();
                    }
                } else {
                    //определить - была ли оплата, делаем это по тарифу (статусу)
                    $paysuccess = $trans_success || ($participant->tariff_id >= $tariff);
                    $message = $paysuccess ? BaseModule::t('rec', 'Your payment was successful') : '';
                }
                //вывести форму оплаты 50$
                $this->render('firstpay', array(
                    'participant' => $participant,
                    'tariff' => $tariff, //флаг успешной оплаты
                    'purse' => $purse, //сумма для активации 20$
                    'amount' => $amount, //сумма для активации 20$
                    'paysuccess' => $paysuccess, //флаг успешной оплаты
                    'instruction' => $instruction, // текст-инструкция
                    'message' => $message, // и текст-сообщение о результате
                ));
            }

            //Если уже есть статус 50$
            else if ($participant->tariff_id == Participant::TARIFF_50) {
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
                    $userlogin = New UserLogin();
                    $userlogin->username = $participant->email;     //авторизация по емейлу!
                    $userlogin->password = Yii::app()->user->getState('pw_original'); //$password;
                    //!!!здесь надо отослать пароль по почте (??????)
                    ///////EmailHelper::sendFromAdmin(array($participant->email), 'Активация в системе', 'businessstart', array('participant'=>$participant));
                    //авторизация
                    $userlogin->authenticate(null, null);
                    if (empty($userlogin->errors)) {              //если авторизация успешна -
                        $this->redirect(Yii::app()->createAbsoluteUrl('office/settings'));                  //редирект на офис
                    } else {
                        throw New CHttpException(405, BaseModule::t('rec', 'Can not log in! Activation code is not valid. Contact the site administrator'));
                    }
                }
                $this->step = 4;
                $this->render('finish', array('participant' => $participant));
            }
        }
    }

    /**
     * Отправка письма (повторного)
     * 
     */
    public function actionSendmail($userid = null) {
        if (isset($userid) && $participant = Participant::model()->findByPk($userid)) {
            $message = BaseModule::t('rec', 'On your mail has been sent again. In the letter you will find a link Click on it.');
            EmailHelper::sendFromAdmin(array($participant->email), BaseModule::t('rec', 'Confirmation of registration'), 'regconfirm', array('participant' => $participant));
            $this->render('confirmsended', array(
                'step' => 1,
                'participant' => $participant,
                'message' => $message,
            ));
        }
    }

}
