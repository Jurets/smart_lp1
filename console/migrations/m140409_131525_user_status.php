<?php

class m140409_131525_user_status extends ProjectMigration
{
    public function safeUp()
    {
        //добавить таблицу статусов
        $this->createTable('tariff', array(
                'id'=>'INT(11) UNSIGNED NOT NULL',
                'name'=>'VARCHAR(60) NOT NULL',
                'shortname'=>'VARCHAR(10) NOT NULL',
                'PRIMARY KEY (id)',
            ), 
            $this->tableSqlOptions
        );
        //добавить значения для статусов
        $this->insert('tariff', array('id'=>0, 'name'=>'Старт начальный', 'shortname'=>'0'));
        $this->insert('tariff', array('id'=>1, 'name'=>'Старт 20$', 'shortname'=>'20'));
        $this->insert('tariff', array('id'=>2, 'name'=>'Старт 50$', 'shortname'=>'50'));
        $this->insert('tariff', array('id'=>3, 'name'=>'investor B1', 'shortname'=>'BC'));
        $this->insert('tariff', array('id'=>4, 'name'=>'investor B2', 'shortname'=>'100'));
        $this->insert('tariff', array('id'=>5, 'name'=>'investor B3', 'shortname'=>'500'));
        $this->insert('tariff', array('id'=>6, 'name'=>'investor B4', 'shortname'=>'1000'));
        
        //добавить новые поля в табл юзеров
        $this->addColumn('tbl_users', 'tariff_id', 'INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT "имя"');

        //добавить внешние ключи
        $this->addForeignKey('FK_users_status', 'tbl_users', 'tariff_id', 'tariff', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_users_status', 'tbl_users');
        $this->dropTable('tariff');
    }

}