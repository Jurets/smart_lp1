<?php

class m140714_061723_standart_transaction_add1 extends CDbMigration
{
	public function up()
	{
            $this->insert('pm_transaction_kind', array('kind_id'=>'8', 'description'=>'призовые'));
	}

	public function down()
	{
           // $this->delete('pm_transaction_kind', array('kind_id = 8'));
            $this->execute('delete from pm_transaction_kind where kind_id = 8');
	}

}
