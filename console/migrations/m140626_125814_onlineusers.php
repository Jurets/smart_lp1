<?php

class m140626_125814_onlineusers extends ProjectMigration
{
    public function safeUp()
    {
        $this->createTable('onlineusers', array(
            'userid' => 'INT(11) NOT NULL COMMENT "ИД юзера"',
            'lastvisit' => 'INT(11) NOT NULL COMMENT "дата и время последнего действия юзера (любой пост на сервер)"',
            'PRIMARY KEY (userid)'
        ),         
        $this->tableSqlOptions . ' COMMENT="список юзеров находящихся в онлайне"');
        
        $this->addForeignKey('FK_onlineusers_users_id', 'onlineusers', 'userid', '{{users}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('onlineusers');
    }
}