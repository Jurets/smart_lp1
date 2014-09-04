<?php

class m140904_170332_faq_add_lng extends CDbMigration
{
	public function up()
	{
            $this->addColumn('faq', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
	}

	public function down()
	{
            $this->dropColumn('faq', 'lng');
	}

}