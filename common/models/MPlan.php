<?php
class MPlan extends CModel
{

    public function attributeNames(){}


    /**
     * @param $participant
     * @param $account
     * @param $password
     * @return bool
     *
     * Function: pay for participation 20$ (УСТАРЕВШАЯ!!!! ПОТОМ УДАЛИТЬ!!!!)
     */
    public static function payRegistration($participant,$account,$password) {
        $pm = new PerfectMoney();              //Попытаться сделать платёж
        /* обязательные параметры */
        $pm->login = $account;                //временно хардкод
        $pm->password = $password;      //временно хардкод
        $pm->payerAccount = $participant->purse;
        $pm->payeeAccount = Requisites::purseActivation();
        //поставить сумму платежа
        $pm->amount = marketingPlanHelper::init()->getMpParam('price_activation'); //20$;
        /* необязательные параметры */
        $pm->payerId = $participant->id;
        $pm->transactionId = PmTransactionLog::TRANSACTION_REGISTRATION;
        $pm->notation = BaseModule::t('dic', 'Registration payment') . $pm->amount . '$';
        $pm->Run('confirm');    //запуск процесса платежа в PerfectMoney

        if (!$pm->hasErrors()) {//если успешно -
            $pw_original = $participant->password; //сохраняем исходный пароль, чтобы нехэшированным отослать его в письме
            Yii::app()->user->setState('pw_original', $pw_original);
            $participant->activateStart(); //активировать (там же хэш пароля и стереть активкод)
            Requisites::depositActivation($pm->amount); //увеличить баланс кошелька активаций
            EmailHelper::sendFromAdmin(array($participant->email), BaseModule::t('dic', 'Activation in system'), 'activation', array('participant'=>$participant, 'pw_original'=>$pw_original)); //отослать емейл
            return true;
        } else {
            $participant->addError('tariff_id', $pm->getError('paymentTransactionStatus'));
            return false;
        }
    }

    /**
     * @param $participant
     * @param $account
     * @param $password
     * @return bool
     *
     * Function: pay for participation 20$
     */
    public static function paymentSCI($participant) {
        $pm = new PerfectMoney();              //Попытаться сделать платёж
        /* обязательные параметры */
        $pm->login = 'login';       //ПРОСТО НЕИМОВЕРНЫЙ КОСТЫЛЬ
        $pm->password = 'password'; //ПРОСТО НЕИМОВЕРНЫЙ КОСТЫЛЬ
        $pm->payerAccount = $participant->purse;
        $pm->payeeAccount = Requisites::purseActivation();
        
        ///////// ДАЛЕЕ ОШИБОЧНЫЙ код
        //определить - на какой кошелёк пойдёт оплата
        /*if ($participant->invite_num == 3 || $participant->invite_num == 4) {  //если третий или четвёртый,
            $pm->payeeAccount = Requisites::purseClub();   //поставить кошелёк активаций системы!!!!!!!!!!!
            $pm->payeeId = null;
        } else {
            $pm->payeeAccount = $participant->referal->purse;    //   то платёж на кошелёк данного реферала
            $pm->payeeId = $participant->referal->id;
        }*/
        ////////////////
        
        
        //поставить сумму платежа
        $pm->amount = marketingPlanHelper::init()->getMpParam('price_activation'); //20$;
        /* необязательные параметры */
        $pm->payerId = $participant->id;
        $pm->transactionId = PmTransactionLog::TRANSACTION_REGISTRATION;
        $pm->notation = BaseModule::t('dic', 'Registration payment') . $pm->amount . '$';
        
        /// комментируем запуск оплаты с помощью API !!!!!!!!!  //$pm->Run('confirm'); 
        $pm->Accept('confirm');    //меняем его на другой метод
        
        if ($pm->hasErrors()) {//если были ошибки - занести ошибку в модель участника
            $participant->addError('tariff_id', $pm->getError('paymentTransactionStatus'));
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $participant
     * @return bool
     *
     * Function: pay for participation 50$
     */
    public static function participationSCI($participant) {
        $pm = new PerfectMoney();              //Попытаться сделать платёж
        /* обязательные параметры */
        $pm->login = 'login';       //ПРОСТО НЕИМОВЕРНЫЙ КОСТЫЛЬ
        $pm->password = 'password'; //ПРОСТО НЕИМОВЕРНЫЙ КОСТЫЛЬ
        $pm->payerAccount = $participant->purse;
        //определить - на какой кошелёк пойдёт оплата
        if ($participant->invite_num == 3 || $participant->invite_num == 4) {  //если третий или четвёртый,
            $pm->payeeAccount = Requisites::purseClub();   //поставить кошелёк активаций системы!!!!!!!!!!!
            $pm->payeeId = null;
        } else {
            $pm->payeeAccount = $participant->referal->purse;    //   то платёж на кошелёк данного реферала
            $pm->payeeId = $participant->referal->id;
        }
        //поставить сумму платежа
        $pm->amount = marketingPlanHelper::init()->getMpParam('price_start'); //50$
        /* необязательные параметры */
        $pm->payerId = $participant->id;
        $pm->transactionId = PmTransactionLog::TRANSACTION_ENTER_BC;
        $pm->notation = BaseModule::t('dic', 'Entry into the business club');
        $pm->Accept('confirm');    //запуск процесса платежа в PerfectMoney

        if ($pm->hasErrors()) {//если были ошибки - занести ошибку в модель участника
            $participant->addError('tariff_id', $pm->getError('paymentTransactionStatus'));
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $participant
     * @param $account
     * @param $password
     * @return bool
     *
     * Function: pay for participation 50$
     */
    public static function payParticipation($participant,$account,$password) {
        $pm = new PerfectMoney();              //Попытаться сделать платёж
        /* обязательные параметры */
        $pm->login = $account;                //временно хардкод
        $pm->password = $password;      //временно хардкод
        $pm->payerAccount = $participant->purse;
        //определить - на какой кошелёк пойдёт оплата
        if ($participant->invite_num == 3 || $participant->invite_num == 4) {  //если третий или четвёртый,
            $pm->payeeAccount = Requisites::purseClub();   //поставить кошелёк активаций системы!!!!!!!!!!!
            $pm->payeeId = null;
        } else {
            $pm->payeeAccount = $participant->referal->purse;    //   то платёж на кошелёк данного реферала
            $pm->payeeId = $participant->referal->id;
        }

        //поставить сумму платежа
        $pm->amount = marketingPlanHelper::init()->getMpParam('price_start'); //50$
        /* необязательные параметры */
        $pm->payerId = $participant->id;
        $pm->transactionId = PmTransactionLog::TRANSACTION_ENTER_BC;
        $pm->notation = BaseModule::t('dic', 'Entry into the business club');
        $pm->Run('confirm');    //запуск процесса платежа в PerfectMoney

        if (!$pm->hasErrors()) {  //если успешно -
            //стать бизнес-участником
            $participant->activateParticipation();
            //перевести взнос на нужный кошелёк
            if ($participant->invite_num == 3 || $participant->invite_num == 4)  {  //если приглашённый 3 или 4
                Requisites::depositClub($pm->amount);                //увеличить баланс кошелька клуба
                if ($participant->invite_num == 3) {                 //если это четвёртый приглашённый
                    $participant->referal->activateBusiness();         //активировать Бизнес-клуб у реферала
                }
            } else {                                                 //иначе
                $participant->referal->depositPurse($pm->amount);     //кинуть сумму в кошелёк рефера (папа или дедушка)
            }
            //отослать письмо про вступление в бизнес-участие
            EmailHelper::sendFromAdmin(array($participant->email), BaseModule::t('dic', 'You have become a business participant'), 'businessstart', array('participant'=>$participant));
            /////                        $this->step = 4;
            /////                        $this->render('finish', array('participant'=>$participant));
            /////                        Yii::app()->end();
            return true;
        } else {
            $participant->addError('tariff_id', $pm->getError('paymentTransactionStatus'));
            return false;
        }
    }

    /**
     * @param $participant
     * @param $account
     * @param $password
     * @param $type_amount
     *
     * Function: pay for change status BC
     */
    public static  function payForChangeStatus($participant,$account,$password,$type_amount){
        $pm = new PerfectMoney();
        /* обязательные параметры */
        $pm->login = $account;
        $pm->password = $password;
        $pm->payerAccount = $participant->purse;
        $pm->payeeAccount = Requisites::purseClub();
        $pm->amount = Tariff::getTariffAmount($type_amount);
        /* необязательные параметры */
        $pm->payerId = $participant->id;
        $pm->payeeId = null;
        $pm->transactionId = Tariff::getTransactionKindTariff($type_amount);
        $pm->notation = BaseModule::t('dic', 'Changing the status of a business club');
        $pm->Run('confirm');   //запуск процесса платежа в PerfectMoney
        if (!$pm->hasErrors()) {  //если успешно -
            Requisites::depositClub($pm->amount);                //увеличить баланс кошелька клуба
            $participant->tariff_id = $type_amount;
            $participant->save();
        } else {
            $participant->addError('tariff_id', $pm->getError('Can\'t change status.Transaction fail.'));
        }
    }

    /**
     * @param $participant
     * @param $account
     * @param $password
     * @param $type_amount
     *
     * Function: pay for change status BC
     */
    public static function payForChangeStatusSCI($participant, $type_amount){
        $pm = new PerfectMoney();
        /* обязательные параметры */
        $pm->login = 'login';       //ПРОСТО НЕИМОВЕРНЫЙ КОСТЫЛЬ
        $pm->password = 'password'; //ПРОСТО НЕИМОВЕРНЫЙ КОСТЫЛЬ
        $pm->payerAccount = $participant->purse;
        $pm->payeeAccount = Requisites::purseClub();
        $pm->amount = Tariff::getTariffAmount($type_amount);
        /* необязательные параметры */
        $pm->payerId = $participant->id;
        $pm->payeeId = null;
        $pm->transactionId = Tariff::getTransactionKindTariff($type_amount);
        $pm->notation = BaseModule::t('dic', 'Changing the status of a business club');

        $pm->Accept('confirm');    //запуск процесса обработки платежа (без API PerfectMoney)

        if ($pm->hasErrors()) {//если были ошибки - занести ошибку в модель участника
            $participant->addError('tariff_id', $pm->getError('Can\'t change status.Transaction fail.'));
            return false;
        } else {               //если успешно -
            Requisites::depositClub($pm->amount);   //увеличить баланс кошелька клуба
            $participant->tariff_id = $type_amount; //увеличить статус
            $participant->save();
            return true;
        }
    }
    
}
?>