<?php
class ProjectMigration extends CDbMigration
{
    protected $tableSqlOptions = 'ENGINE=InnoDB CHARSET=utf8';
    
    protected function importSqlDump($sqlDumpPath)
    {
        //$sqlDumpPath = Yii::getPathOfAlias('application.modules.install.data').DIRECTORY_SEPARATOR.'dump.sql';
        $sqlRows=preg_split("/--\s*?--.*?\s*--\s*/", file_get_contents($sqlDumpPath));

        //$connection = new CDbConnection($this->getDsn(), $this->dbUserName, $this->dbPassword);
        //$connection->charset='utf8';
        //$connection->active=true;
        //$connection->createCommand("SET NAMES 'utf8';");
        $connection = $this->getDbConnection();

        foreach($sqlRows as $q)
        {
            $q=trim($q);
            if(!empty($q))
            {
                if(strpos($q, 'DROP TABLE IF EXISTS')===false)
                    $connection->createCommand($q)->execute();
                else
                {
                    $lines=preg_split("/(\r?\n)+/", $q);
                    $dropQuery=$lines[0];
                    array_shift($lines);
                    $query=implode('', $lines);

                    $connection->createCommand($dropQuery)->execute();
                    $connection->createCommand($query)->execute();
                }
            }
        }
    }    
}
?>
