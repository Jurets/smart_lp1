<?php

class m140703_100029_tbl_users_new_colum_new_email extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{users}}', 'new_email', 'VARCHAR(150)  NULL');
	}

	public function down()
	{
        $this->dropColumn('tbl_users','new_email');
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