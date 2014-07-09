<?php

class m140709_081122_standart_transaction_v2 extends CDbMigration
{
    public function up()
    {
        $this->delete('pm_transaction_kind', '');
        $this->insert('pm_transaction_kind', array('kind_id'=>'0','description'=>'тест'));
        $this->insert('pm_transaction_kind', array('kind_id'=>'1','description'=>'регистрация'));
        $this->insert('pm_transaction_kind', array('kind_id'=>'2','description'=>'вступление в клуб'));
        $this->insert('pm_transaction_kind', array('kind_id'=>'3','description'=>'бронзовый инвестор'));
        $this->insert('pm_transaction_kind', array('kind_id'=>'4','description'=>'серебряный инвестор'));
        $this->insert('pm_transaction_kind', array('kind_id'=>'5','description'=>'золотой инвестор'));
        $this->insert('pm_transaction_kind', array('kind_id'=>'6','description'=>'комиссионные'));
        $this->insert('pm_transaction_kind', array('kind_id'=>'7','description'=>'благотворительность'));

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