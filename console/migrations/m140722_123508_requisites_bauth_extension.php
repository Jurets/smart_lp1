<?php

class m140722_123508_requisites_bauth_extension extends CDbMigration
{
	public function up()
	{
            $this->addColumn('requisites', 'bpm_login', 'VARCHAR(255) DEFAULT NULL AFTER purse_club');
            $this->addColumn('requisites', 'bpm_password', 'VARCHAR(255) DEFAULT NULL AFTER bpm_login');
	}

	public function down()
	{
            $this->dropColumn('requisites', 'bpm_login');
            $this->dropColumn('requisites', 'bpm_password');
	}
}