<?php

class m140529_083734_newtable_gmt extends ProjectMigration
{
	public function safeUp()
	{
        $this->createTable('gmt', array(
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            'name' => 'VARCHAR(255) NOT NULL',
            'code' => 'VARCHAR(255) NOT NULL',
            'PRIMARY KEY (id)'
        ), $this->tableSqlOptions);
        Gmt::fillTimeZones();
	}

	public function safeDown()
	{
		$this->dropTable('gmt');
	}

}