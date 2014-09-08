<?php

class m140905_123715_requisites_drop_lng extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('requisites', 'lng');       
	}

	public function down()
	{
       $this->addColumn('requisites', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
	}
}
