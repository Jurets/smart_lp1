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
        $pm->amount = Tariff::getTariffAmount(Participant::TARIFF_50); //'50.00';   
        /* необязательные параметры */
        $pm->payerId = $participant->id;
        $pm->transactionId = PmTransactionLog::TRANSACTION_ENTER_BC;
        $pm->notation = 'Вступление в бизнес-клуб';
        $pm->Run('confirm');    //запуск процесса платежа в PerfectMoney

        if (!$pm->hasErrors()) {  //если успешно -
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
        $pm->notation = 'Изменение статсуса в бизнес клубе';
        $pm->Run('confirm');   //запуск процесса платежа в PerfectMoney
        if (!$pm->hasErrors()) {  //если успешно -
            $participant->tariff_id = $type_amount;
            $participant->save();
        }else{
            $participant->addError('tariff_id', $pm->getError('Can\'t change status.Transaction fail.'));
        }
    }

}
?>