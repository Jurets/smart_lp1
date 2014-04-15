<?php

class m140415_080835_alter_table_faq_datetime extends CDbMigration
{
	public function up()
	{
            $this->alterColumn('faq', 'created', 'DATETIME NULL DEFAULT NULL');
	}

	public function down()
	{
		 $this->alterColumn('faq', 'created', 'DATE NULL DEFAULT NULL');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}