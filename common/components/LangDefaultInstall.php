<?php
class LangDefaultInstall {
    private static $items = array();
    private static function save(){
       $sql = 'INSERT INTO SourceMessage (message) VALUES ';
        foreach (self::$items as $one){
            $sql .= '("'.htmlspecialchars($one).'"),';
        }
        $sql[strrpos($sql, ',')] = ';';
        
        Yii::app()->db->createCommand($sql)->execute(); 
    }
    public static function install(){
        self::readMatrixFromFile();
        self::save();
    }
    
    public static function readMatrixFromFile(){
        $path = Yii::app()->getBasePath().'/../common/components/english.txt';
        //авариный рабочий вариант, если алиасы вдруг упадут
        //$path = Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'english.txt';
        $path = Yii::getPathOfAlias('common.components.').DIRECTORY_SEPARATOR.'english.txt';
        $desc = fopen($path, 'r');
        
        while(!feof($desc)){
            $buff = trim(fgets($desc));
            if(empty($buff)) continue;
            self::$items[] = $buff;
            echo $buff . PHP_EOL;
        }        
        fclose($desc);
        self::$items = array_unique(self::$items);
    }
}
