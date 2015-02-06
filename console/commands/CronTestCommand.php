<?php
class CronTestCommand extends CConsoleCommand {
    public $path;
    public $mail;
    public function run($args){
        parent::run($args);
    }
    public function actionIndex(){
        file_put_contents($this->path.date('Y-m-d H:i:s'), 'крон работает нормально');
        mail($this->mail, 'Cron test letter', 'Cron test task is ok:'.date('Y-m-d H:i:s'));
    }
}

