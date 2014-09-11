<?php

class m140910_190410_language_reinstall_v5 extends ProjectMigration
{
	public function up()
	{
           $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lang_ver5.sql'); // ПЕРЕСОЗДАНИЕ И ИНИЦИАЛИХАЦИЯ ТАБЛИЦ
	}

	public function down()
	{
            $this->dropTable('Message');
            $this->dropTable('SourceMessage');
            $this->dropTable('Languages'); 
	}
}