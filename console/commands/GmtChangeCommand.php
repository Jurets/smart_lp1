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
    }
}

?>
