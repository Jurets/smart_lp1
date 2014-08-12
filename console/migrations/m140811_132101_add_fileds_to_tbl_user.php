<?php

class m140811_132101_add_fileds_to_tbl_user extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{users}}', 'income', 'INT NOT NULL DEFAULT 0 AFTER purse');
        $this->addColumn('{{users}}', 'transfer_fund', 'INT NOT NULL DEFAULT 0 AFTER income');
	}

	public function down()
	{
        $this->dropColumn('{{users}}', 'income');
        $this->dropColumn('{{users}}', 'transfer_fund');
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