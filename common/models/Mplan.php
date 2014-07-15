<?php
class MPlan extends CModel
{

    public function attributeNames(){}
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
            Yii::app()->user->setFlash('success', "Ваша оплата прошла успешно!");
            /////                        $this->step = 4;
            /////                        $this->render('finish', array('participant'=>$participant));
            /////                        Yii::app()->end();
            return true;
        } else {
            $participant->addError('tariff_id', $pm->getError('paymentTransactionStatus'));
            return false;
        }
    }

}
?>