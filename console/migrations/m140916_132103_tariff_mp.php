<?php

class m140916_132103_tariff_mp extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('tariff', 'mathparam', 'VARCHAR(255) DEFAULT NULL');
        
        $this->update('tariff', array('mathparam'=>'price_activation'), 'id = :id', array(':id'=>Participant::TARIFF_20));
        $this->update('tariff', array('mathparam'=>'price_start'), 'id = :id', array(':id'=>Participant::TARIFF_50));
        $this->update('tariff', array('mathparam'=>'cost_B1'), 'id = :id', array(':id'=>Participant::TARIFF_BC_BRONZE));
        $this->update('tariff', array('mathparam'=>'cost_B2'), 'id = :id', array(':id'=>Participant::TARIFF_BC_SILVER));
        $this->update('tariff', array('mathparam'=>'cost_B3'), 'id = :id', array(':id'=>Participant::TARIFF_BC_GOLD));
	}

	public function safeDown()
	{
        $this->dropColumn('tariff', 'mathparam');
	}
	
}