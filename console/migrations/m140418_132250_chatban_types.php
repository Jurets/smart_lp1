<?php

class m140418_132250_chatban_types extends ProjectMigration
{
	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('ban_type', array(
              'id' => 'INT(11) NOT NULL',
              'name' => 'varchar(50) NOT NULL COMMENT "название"',
              'period'=>'INT(11) DEFAULT NULL COMMENT "период бана (в секундах)"',
              'PRIMARY KEY (id)',
            ),
            $this->tableSqlOptions
        );
        //ввести в таблицу типы банов
        $this->insert('ban_type', array('id'=>1, 'name'=>'бан 1 час', 'period'=>3600));
        $this->insert('ban_type', array('id'=>2, 'name'=>'бан 1 день', 'period'=>3600 * 24));
        $this->insert('ban_type', array('id'=>3, 'name'=>'бан 1 неделя', 'period'=>3600 * 24 * 7));
        $this->insert('ban_type', array('id'=>4, 'name'=>'бан 1 месяц', 'period'=>3600 * 24 * 30));
        $this->insert('ban_type', array('id'=>5, 'name'=>'черный список', 'period'=>null));
	}

	public function safeDown()
	{
        $this->dropTable('ban_type');
	}
	
}