<?php

/**
 * Исправление часовых поясов
 * 
 * 
 */
class GmtChangeCommand extends CConsoleCommand {
    
    public function run($args) 
    {
        Gmt::fillTimeZones();
        /*$db = Yii::app()->db;
        $db->createCommand()->delete('gmt');

        $timezonesList = timezone_identifiers_list();
        $strSQL = 'INSERT INTO `gmt` VALUES ';
        $count = 1;
        foreach($timezonesList as $timezone){
            $strSQL .= "(null, '{$timezone}', 0), ";                  
        }
        $strSQL = trim($strSQL);
        if($strSQL[strlen($strSQL) - 1] === ','){
            $strSQL[strlen($strSQL) - 1] = ';';
        }
//        $strSQL .= ';';
        $db->createCommand('ALTER TABLE `gmt` AUTO_INCREMENT=1;')->execute();
        $db->createCommand($strSQL)->execute();*/        
    }
}

?>
