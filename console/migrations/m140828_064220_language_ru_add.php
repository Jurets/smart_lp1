<?php

class m140828_064220_language_ru_add extends ProjectMigration
{
	public function up()
	{
           $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ru.sql');
	}

	public function down()
	{
		echo 'OK';
                return true;
	}

}