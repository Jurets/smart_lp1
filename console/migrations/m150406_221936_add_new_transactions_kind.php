<?php

class m150406_221936_add_new_transactions_kind extends CDbMigration
{
	public function up()
	{
            $this->insert('pm_transaction_kind', ['kind_id'=>21, 'description'=>'bot-регистрация']);
	}

	public function down()
	{
		echo "m150406_221936_add_new_transactions_kind does not support migration down.\n";
		return false;
	}

}