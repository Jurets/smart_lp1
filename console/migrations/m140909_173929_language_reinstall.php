<?php

class m140909_173929_language_reinstall extends ProjectMigration
{
	public function up()
	{
           $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lang_ver4.sql'); // ПЕРЕСОЗДАНИЕ И ИНИЦИАЛИХАЦИЯ ТАБЛИЦ
	}

	public function down()
	{
            $this->dropTable('Message');
            $this->dropTable('SourceMessage');
            $this->dropTable('Languages'); 
	}
}