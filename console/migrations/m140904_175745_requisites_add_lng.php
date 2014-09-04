<?php

class m140904_175745_requisites_add_lng extends CDbMigration
{
	public function up()
	{
            $this->addColumn('requisites', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
	}

	public function down()
	{
            $this->dropColumn('requisites', 'lng');
	}
}