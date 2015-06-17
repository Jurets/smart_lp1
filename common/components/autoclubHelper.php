<?php

class autoclubHelper {

    private $user; // биндится модель пользователя, выбранная в контроллере
    private $actAmount; // сколько стоит нормальная активация в рамках текущей версии маркетинг-плана (20)
    private $startAmount; // сколько сколько стоит нормальный старт в рамках текущей версии маркетинг-плана (50)
    private $autoclubPurse; // массив данных по буфферному кошельку для оплаты с него
    private $purseA; // кошелек активации
    private $purseB; // кошелек клуба
    private $data; // специальная структура данных (для разных этапов она своя) для манипулирования отображением view

    public function __construct($participant) {
        $this->user = $participant;
        $this->autoclubPurse = NULL;
        $this->purseA = NULL;
        $this->purseB = NULL;
        $this->data = array();
    }

    // установщик параметров маркетинг-плана согласно выбранной в админке версии
    private function initMpParams() {
        $mp = marketingPlanHelper::init()->getMpParams();
        $this->actAmount = $mp['price_activation'];
        $this->startAmount = $mp['price_start'];
    }

    // установщик всех необходимых реквизитов для кошелька клуба
    private function initAutoclubPurse() {
        $purseSQL = 'SELECT purse_autoclub, autoclub_login, autoclub_password FROM requisites WHERE id = "JVMS" ';
        $purseData = Yii::app()->db->createCommand($purseSQL)->query()->read();
        $this->autoclubPurse = [
            'autoclub_account' => $purseData['purse_autoclub'],
            'autoclub_login' => $purseData['autoclub_login'],
            'autoclub_password' => $purseData['autoclub_password'],
        ];
    }

    // получение кошельков активации и бизнес-клуба
    private function initABPurses() {
        $purseSQL = 'SELECT purse_activation, purse_club FROM requisites WHERE id = "JVMS" ';
        $purseData = Yii::app()->db->createCommand($purseSQL)->query()->read();
        $this->purseA = $purseData['purse_activation'];
        $this->purseB = $purseData['purse_club'];
    }

    // вычисление полной суммы для выплатны на кошелек автоклуба
    private function returnCommonAmount() {
        $stA = $this->actAmount;
        $st = $this->startAmount;
       // $tr1 = $stA * 5;
        //$tr2 = $st;
        $tr3 = $st * 2;
        return /*$tr1 + $tr2 +*/ $tr3;
    }

    public static function init($participant) {
        return new autoclubHelper($participant);
    }

    // проверка наличия записи по факту успешной оплаты на кошелек автоклуба
    public static function checkAutoclubRecord($participant) {
        $exist = AutoclubPaymentRegister::model()->findByPk($participant->id);
        if (!is_null($exist)) {
            return TRUE;
        }
        return FALSE;
    }

    // проверка записи на завершенность для использования в контроллере - все три стадии - 1
    public static function checkAutoclubRecordComplete($participant) {
        $model = AutoclubPaymentRegister::model()->findByPk($participant->id);
        if (/*$model->st1 == 1 && $model->st2 == 1 &&*/ $model->st3 == 1) {
            return TRUE;
        }
        return FALSE;
    }

    // подготавливает данные формы на интерфейс PM для оплаты на кошелек автоклуба
    public function renderMainPaymentForm() {
        $this->data['sign'] = 'pay';
        $this->initMpParams();
        $this->initAutoclubPurse(); // получаем кошелек автоклуба
        $this->data['purse_autoclub'] = $this->autoclubPurse['autoclub_account'];
        $this->data['amount'] = $this->returnCommonAmount();
        $this->data['currency'] = 'USD';
        return $this;
    }

    // подготовка данных для отрисовки формы подтверждения
    public function renderConfirmForm() {
        $this->data['sign'] = 'confirm';
        return $this;
    }

    // подготовка данных к выводу поздравлений с успешным вступлением в клуб посредством лишь платежей
    public function renderCongratulations() {
        $this->data['sign'] = 'congratulate';
        return $this;
    }

    // служебный метод по извлечению подготовленных данных в контроллер
    public function getData() {
        return $this->data;
    }

    // процесс выплат с автоклуба посредством PM API
    public function transferProcess() {
        // получение исходных данных
        $this->initMpParams();
        $this->initAutoclubPurse();
        $this->initABPurses();
        // записываем те параметры API которые неизменны для трех видов транзакций
        $record = AutoclubPaymentRegister::model()->findByPk($this->user->id);
//        if ($record->st1 == 0) { // первая транзакция - оплата идет на счет кошелька активации
//            $attrAPI = array(
//            'payerAccount' => $this->autoclubPurse['autoclub_account'],
//            'login' => $this->autoclubPurse['autoclub_login'],
//            'password' => $this->autoclubPurse['autoclub_password'],
//        );
//            $stA = $this->actAmount;
//            $st = $this->startAmount;
//            $tr1 = $stA * 5 - ($stA * 5 + $st) * 0.02; // расчет суммы для первой транзакции
//            $attrAPI['payeeAccount'] = $this->purseA;
//            $attrAPI['amount'] = $tr1;
//            $attrAPI['payeeId'] = NULL;
//            $attrAPI['payerId'] = $this->user->id;
//            $attrAPI['transactionId'] = 31;
//            $attrAPI['notation'] = 'autoclub step1 Activation';
//            $this->paymentByAPI($attrAPI, $record, 1);
//        }
//        if ($record->st2 == 0) { // расчет суммы для второй транзакции  - "дедушкина" транзакция
//            $attrAPI = array(
//            'payerAccount' => $this->autoclubPurse['autoclub_account'],
//            'login' => $this->autoclubPurse['autoclub_login'],
//            'password' => $this->autoclubPurse['autoclub_password'],
//        );
//            $st = $this->startAmount;
//            $tr2 = $st;
//            $grandfather = $this->user->referal;
//            $attrAPI['payeeAccount'] = $grandfather->purse;
//            $attrAPI['amount'] = $tr2;
//            $attrAPI['payeeId'] = $grandfather->id;
//            $attrAPI['payerId'] = $this->user->id;
//            $attrAPI['transactionId'] = 2;
//            $attrAPI['notation'] = 'autoclub step2 Second Invitate';
//            $this->paymentByAPI($attrAPI, $record, 2);
//        }
        if ($record->st3 == 0) {
            $attrAPI = array(
            'payerAccount' => $this->autoclubPurse['autoclub_account'],
            'login' => $this->autoclubPurse['autoclub_login'],
            'password' => $this->autoclubPurse['autoclub_password'],
        );
            $st = $this->startAmount;
            $tr3 = $st * 2;
            $attrAPI['payeeAccount'] = $this->purseB;
            $attrAPI['amount'] = $tr3;
            //$attrAPI['amount'] = 0.123; // тест
            $attrAPI['payeeId'] = NULL;
            $attrAPI['payerId'] = $this->user->id;
            $attrAPI['transactionId'] = 32;
            $attrAPI['notation'] = 'autoclub step3 into Club Purse';
            $this->paymentByAPI($attrAPI, $record, 3);
        }
        // если все три транзакции прошли успешно - переводим пользователя в клуб со статусом B1
        if (/*$record->st1 == 1 && $record->st2 == 1 &&*/ $record->st3 == 1) {
            $this->user->tariff_id = 3;
            $this->user->autoclub = 1;
            $this->user->club_date = date('Y-m-d H:i:s');
            $this->user->save();
        }
    }

    private function paymentByAPI($attr, $record, $st) {
        $model = new PerfectMoney;
        /* обязательные параметры постоянные */
        $model->login = $attr['login'];
        $model->password = $attr['password'];
        $model->payerAccount = $attr['payerAccount'];
        /* обязательные параметры переменные */
        $model->payeeAccount = $attr['payeeAccount'];
        $model->amount = $attr['amount'];
        $model->payeeId = $attr['payeeId'];
        $model->transactionId = $attr['transactionId'];
        /* необязательные параметры */
        $model->notation = $attr['notation'];
        if(isset($attr['payerId'])){
            $model->payerId = $attr['payerId'];
        }
//        
        try {
//            $trn = Yii::app()->db->beginTransaction();
            $model->Run();
            if (is_null($model->getError('paymentTransactionStatus'))) {
                switch ($st) {
                    case 1:
                        $record->st1 = 1;
                        $record->save();
                        break;
                    case 2:
                        $record->st2 = 1;
                        $record->save();
                        break;
                    case 3:
                        $record->st3 = 1;
                        $record->save();
                        break;
                }
              //  $trn->commit();
               
            } else {
               // $trn->rollback();
                
            }
       } catch (Exception $ex) {
            
       }
    }

}
