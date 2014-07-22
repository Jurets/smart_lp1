<?php

class WeeklyPaymentCommand extends CConsoleCommand {
    public function run($args) {
        parent::run($args);
    }
    public function actionIndex(){
        set_time_limit(28800); // время жизни скрипта установлено 
        $periodSource = SiapPeriodes::dateIntervalAutomate();
        SiapExecute::executeInstructions(/*$periodSource['period_id']*/);
    }
}
?>