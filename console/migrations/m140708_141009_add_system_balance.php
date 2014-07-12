<?php

class m140708_141009_add_system_balance extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('requisites', 'balance_activation', 'FLOAT NOT NULL DEFAULT 0 AFTER purse_activation');
        $this->addColumn('requisites', 'balance_club', 'FLOAT NOT NULL DEFAULT 0 AFTER purse_club');
        $this->addColumn('requisites', 'balance_investor', 'FLOAT NOT NULL DEFAULT 0 AFTER purse_investor');
        $this->addColumn('requisites', 'balance_fdl', 'FLOAT NOT NULL DEFAULT 0 AFTER purse_fdl');
	}

	public function safeDown()
	{
        $this->addColumn('requisites', 'balance_activation');
        $this->addColumn('requisites', 'balance_club');
        $this->addColumn('requisites', 'balance_investor');
        $this->addColumn('requisites', 'balance_fdl');
	}
}