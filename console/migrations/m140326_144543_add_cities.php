<?php

class m140326_144543_add_cities extends ProjectMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->clearTables();

        $this->createTable('countries', array(
              'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
              'name' => 'varchar(255) NOT NULL COMMENT "название"',
              'code' => 'varchar(10) NOT NULL COMMENT "двухбуквенный международный код"',
              'code_num' => 'INT(11) NOT NULL COMMENT "почтовый код"',
              'phone_code' => 'INT(4) NOT NULL COMMENT "телефонный код"',
              'gmt_id' => 'INT(11) NOT NULL COMMENT "часовой пояс"',
              'PRIMARY KEY (id)',
              'KEY code (code)',
          ), 
          $this->tableSqlOptions . ' AUTO_INCREMENT=245 AVG_ROW_LENGTH=67'
        );

        $this->createTable('cities', array(
              'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
              'country_id' => 'INT(11) NOT NULL COMMENT "ссылка на страну"',
              'name' => 'varchar(255) NOT NULL COMMENT "название"',
              'PRIMARY KEY (id)',
              'KEY country_id (country_id)',
              'KEY name_ru (name)',
          ), 
          $this->tableSqlOptions . ' AUTO_INCREMENT=1967 AVG_ROW_LENGTH=52'
        );
        
        $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cities.sql');
	}

    private function clearTables() {
        $this->execute('DROP TABLE IF EXISTS cities');
        $this->execute('DROP TABLE IF EXISTS countries');
        $this->execute('DROP TABLE IF EXISTS requisites');
    }
    
	public function safeDown()
	{
        $this->clearTables();
	}
	
}