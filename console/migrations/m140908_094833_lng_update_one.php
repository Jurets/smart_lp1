<?php

class m140908_094833_lng_update_one extends CDbMigration
{
	public function up()
	{
            $this->alterColumn('news', 'lng', 'varchar(3) DEFAULT NULL COMMENT "Язык контента" AFTER id');
            $this->alterColumn('faq', 'lng', 'varchar(3) DEFAULT NULL COMMENT "Язык контента" AFTER id');
            $this->alterColumn('training', 'lng', 'varchar(3) DEFAULT NULL COMMENT "Язык контента" AFTER id');
           
	}

	public function down()
	{
            $this->alterColumn('news', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
            $this->alterColumn('faq', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
            $this->alterColumn('training', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
	}
}