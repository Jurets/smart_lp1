<?php

class m150513_155710_add_autoclub_transaction_kinds extends CDbMigration
{
	public function up()
	{
            $this->insert('pm_transaction_kind', array('kind_id'=>'31', 'description'=>'directclub активационная'));
            $this->insert('pm_transaction_kind', array('kind_id'=>'32', 'description'=>'directclub выплата в клуб'));
	}

	public function down()
	{
		echo "m150513_155710_add_autoclub_transaction_kinds does not support migration down.\n";
		return false;
	}
}