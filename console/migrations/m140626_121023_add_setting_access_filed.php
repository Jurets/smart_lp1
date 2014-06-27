<?php

class m140626_121023_add_setting_access_filed extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{users}}', 'country_access', 'INT NOT NULL DEFAULT "0"');
        $this->addColumn('{{users}}', 'city_access', 'INT NOT NULL DEFAULT "0"');
        $this->addColumn('{{users}}', 'skype_access', 'INT NOT NULL DEFAULT "0"');
        $this->addColumn('{{users}}', 'email_access', 'INT NOT NULL DEFAULT "0"');
	}

	public function down()
	{
        $this->dropColumn('tbl_users','country_access');
        $this->dropColumn('tbl_users','city_access');
        $this->dropColumn('tbl_users','skype_access');
        $this->dropColumn('tbl_users','email_access');
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