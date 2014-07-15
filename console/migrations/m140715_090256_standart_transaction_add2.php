<?php

class m140715_090256_standart_transaction_add2 extends CDbMigration
{
	public function up()
	{
		$this->insert('pm_transaction_kind', array('kind_id'=>'9', 'description'=>'доход системе'));
	}

	public function down()
	{
		$this->execute('delete from pm_transaction_kind where kind_id = 9');
	}
}
