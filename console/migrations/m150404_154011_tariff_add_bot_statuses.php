<?php

class m150404_154011_tariff_add_bot_statuses extends CDbMigration
{
	public function up()
	{
            $this->insert('tariff', array('id'=>'22', 'name'=>'bot start $50', 'shortname'=>'bot_start'));
            $this->insert('tariff', array('id'=>'23', 'name'=>'bot investor B1', 'shortname'=>'bot_bc'));
            $this->insert('tariff', array('id'=>'24', 'name'=>'bot investor B2', 'shortname'=>'bot_100'));
            $this->insert('tariff', array('id'=>'25', 'name'=>'bot investor B3', 'shortname'=>'bot_500'));
            $this->insert('tariff', array('id'=>'26', 'name'=>'bot investor B4', 'shortname'=>'bot_1000'));
	}

	public function down()
	{
		echo "m150404_154011_tariff_add_bot_statuses does not support migration down.\n";
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