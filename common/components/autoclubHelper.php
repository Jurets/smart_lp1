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

    private function initMpParams() {
        $mp = marketingPlanHelper::init()->getMpParams();
        $this->actAmount = $mp['price_activation'];
        $this->startAmount = $mp['price_start'];
    }

    private function initAutoclubPurse() {
        $purseSQL = 'SELECT purse_autoclub, autoclub_login, autoclub_password FROM requisites WHERE id = "JVMS" ';
        $purseData = Yii::app()->db->createCommand($purseSQL)->query()->read();
        $this->autoclubPurse = [
            'autoclub_account' => $purseData['purse_autoclub'],
            'autoclub_login' => $purseData['autoclub_login'],
            'autoclub_password' => $purseData['autoclub_password'],
        ];
    }

    private function initABPurses() {
        $purseSQL = 'SELECT purse_activation, purse_club FROM requisites WHERE id = "JVMS" ';
        $purseData = Yii::app()->db->createCommand($purseSQL)->query()->read();
        $this->purseA = $purseData['purse_activation'];
        $this->purseB = $purseData['purse_club'];
    }

    public static function init($participant) {
        return new autoclubHelper($participant);
    }

    public function renderStep1() {
        
        return $this;
    }
    
    public function getData(){
        return $this->data;
    }
    
    public function test() {
        
    }

}
