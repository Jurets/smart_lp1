<?php

class m140908_172802_reinstall_languages extends ProjectMigration
{
	public function up()
	{
           $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lang_ver3.sql'); // ПЕРЕСОЗДАНИЕ И ИНИЦИАЛИХАЦИЯ ТАБЛИЦ
	}

	public function down()
	{
            $this->dropTable('Message');
            $this->dropTable('SourceMessage');
            $this->dropTable('Languages'); 
	}	
}