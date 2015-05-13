<?php

class m150512_141930_add_autoclub_purse_into_requisites extends CDbMigration
{
	public function up()
	{
            $this->addColumn('requisites', 'purse_autoclub', 'VARCHAR(255) DEFAULT NULL COMMENT "буфферный кошелек для вступления в B1 без 4-х" AFTER balance_fdl');
            $this->addColumn('requisites', 'autoclub_login', 'VARCHAR(255) DEFAULT NULL COMMENT "логин буфферного кошелька" AFTER purse_autoclub');
            $this->addColumn('requisites', 'autoclub_password', 'VARCHAR(255) DEFAULT NULL COMMENT "пароль буфферного кошелька" AFTER autoclub_login');
	}

	public function down()
	{
            $this->dropColumn('requisites', 'purse_autoclub');
            $this->dropColumn('requisites','autoclub_login');
            $this->dropColumn('requisites', 'autoclub_password');
	}
}