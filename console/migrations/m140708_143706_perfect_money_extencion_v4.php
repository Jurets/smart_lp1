<?php

class m140708_143706_perfect_money_extencion_v4 extends CDbMigration
{
	public function up()
	{
           $this->dropForeignKey('fk_knd', 'pm_transaction_log');
           $this->alterColumn('pm_transaction_kind', 'kind_id', 'smallint(6) NOT NULL');
           $this->addForeignKey('fk_knd', 'pm_transaction_log', 'tr_kind_id', 'pm_transaction_kind', 'kind_id','RESTRICT', 'RESTRICT');
	}

	public function down()
	{
            $this->dropForeignKey('fk_knd', 'pm_transaction_log');
            $this->alterColumn('pm_transaction_kind', 'kind_id', 'smallint(6) NOT NULL AUTO_INCREMENT');
            $this->addForeignKey('fk_knd', 'pm_transaction_log', 'tr_kind_id', 'pm_transaction_kind', 'kind_id','RESTRICT', 'RESTRICT');
	}
}