<?php

class m140715_121915_add_filed_trkind_tbl_tariff extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('tariff', 'tr_kind', 'INT(11) DEFAULT NULL COMMENT "id типа транзакции для перехода на этот статус"');
        $this->update('tariff', array('tr_kind'=>'1'), 'id = 1');
        $this->update('tariff', array('tr_kind'=>'2'), 'id = 2');
        $this->update('tariff', array('tr_kind'=>'3'), 'id = 4');
        $this->update('tariff', array('tr_kind'=>'4'), 'id = 5');
        $this->update('tariff', array('tr_kind'=>'5'), 'id = 6');
    }

    public function safeDown()
    {
        $this->dropColumn('tariff','tr_kind');
       // $this->delete('tariff', 'tr_kind');
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