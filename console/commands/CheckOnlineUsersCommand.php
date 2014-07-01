<?php
/**
*  Команда: онлайн-проверка юзеров (по активности их в течение периода)
*  запускается в планировщике cron с каким-то интервалом (например 1 мин):
*  > crontab -e
*
*  в файле прописать ("* /30" - писать без пробела!):
*   * /1 * * * * php /var/www/cron.php checkonlineusers
*/
class CheckOnlineUsersCommand extends CConsoleCommand 
{
    //интервал времени (в секундах), в течение которого юзер считается онлайн 
    public $onlineInterval = 1800;   //по умолачнию - 30 минут  
    
    //флаг: тестовый режим
    public $testmode = false;         
    
    /**
    * главное действие команды
    * 
    */
    public function actionIndex() {
        //получить список пользователей Онлайн
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $command = Yii::app()->db->createCommand();
            $dataReader = $command
                ->select('*')
                ->from('onlineusers')
                ->query();
            //$rows = $dataReader->readAll();
            while(($row = $dataReader->read()) !== false) {
                $now = time();
                $diff_in_seconds = $now - $row['lastvisit'];     //посчитать интервал
                echo 'user id: ' . $row['userid'] . "\n\r" . 'now: ' . date("Y-m-d h:i:s", $now) . "\n\r lastvisit " . date("Y-m-d h:i:s", $row['lastvisit']) . "\n\r diff in seconds: " . $diff_in_seconds . "\n\r";
                if ($diff_in_seconds >= $this->onlineInterval) {   //если интервал превысил допустимый
                    echo 'deleted: ' . $command->delete('onlineusers', 'userid = :userid', array(':userid'=>$row['userid'])) . "\n\r"; //удалить его из олнайн-списка
                }
            }
            $transaction->commit();
        } catch(CDbException $e) {
            $transaction->rollback();
            Yii::log('--- ОШИБКА операции онлайн-юзеров: ' . $e->message, CLogger::LEVEL_INFO, $this->notifyType);
        }
    }
    
}
  
?>
