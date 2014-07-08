<?php

class m140708_125124_standart_transaction extends CDbMigration
{
	public function up()
	{
        $this->insert('pm_transaction_kind', array('description'=>'комиссионные'));
        $this->insert('pm_transaction_kind', array('description'=>'благотворительность'));
        $this->insert('pm_transaction_kind', array('description'=>'регистрация'));
        $this->insert('pm_transaction_kind', array('description'=>'вступление в клуб'));
        $this->insert('pm_transaction_kind', array('description'=>'бронзовый инвестор'));
        $this->insert('pm_transaction_kind', array('description'=>'серебряный инвестор'));
        $this->insert('pm_transaction_kind', array('description'=>'золотой инвестор'));
	}

	public function down()
	{
        echo "m140708_125124_standart_transaction does not support migration down.\n";
		return false;
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