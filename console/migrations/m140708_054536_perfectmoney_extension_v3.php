<?php

class m140708_054536_perfectmoney_extension_v3 extends CDbMigration
{
	public function up()
	{
            $this->alterColumn('pm_transaction_log', 'from_user_id', 'int(11) DEFAULT NULL');
            $this->alterColumn('pm_transaction_log', 'to_user_id', 'int(11) DEFAULT NULL');
	}

	public function down()
	{
            $this->alterColumn('pm_transaction_log', 'from_user_id', 'int(11) NOT NULL');
            $this->alterColumn('pm_transaction_log', 'to_user_id', 'int(11) NOT NULL');
	}

}