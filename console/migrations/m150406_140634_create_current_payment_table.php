<?php

class m150406_140634_create_current_payment_table extends CDbMigration
{
	public function up()
	{
            $this->createTable('current_clubmembers_payment', array(
                'id' => 'VARCHAR(4) NOT NULL comment"curr - для идентификации текущих выплат по клубу"',
                'b1' => 'float DEFAULT NULL',
                'b2' => 'float DEFAULT NULL',
                'b3' => 'float DEFAULT NULL',
                'b4' => 'float DEFAULT NULL',
                'PRIMARY KEY (id)'
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
            $this->insert('current_clubmembers_payment', array('id'=>'curr'));
	}

	public function down()
	{
            $this->dropTable('current_clubmembers_payment');
	}
}