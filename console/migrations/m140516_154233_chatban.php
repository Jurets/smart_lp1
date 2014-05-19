<?php
/**
* таблица истории банов юзера в чате
*/
class m140516_154233_chatban extends ProjectMigration
{
	public function safeUp()
	{
        $this->createTable('chatban', array(
                'id'=>'INT(11) NOT NULL AUTO_INCREMENT',
                'user_id'=>'INT(11) NOT NULL COMMENT "ИД юзера"',
                'create_at'=>'TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT "время постановки"',
                'bantype_id'=>'INT(11) NOT NULL COMMENT "ИД типа бана"',
                'active'=>'TINYINT(1) NOT NULL COMMENT "активность бана (0 - нет, 1 - да)"',
                'comment'=>'VARCHAR(255) DEFAULT NULL COMMENT "комментарий причины бана"',
                'PRIMARY KEY (id)'
            ),
            $this->tableSqlOptions
        );
        //внешние ключи
        $this->addForeignKey('FK_chatban_user', 'chatban', 'user_id', 'tbl_users', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_chatban_bantype', 'chatban', 'bantype_id', 'ban_type', 'id', 'RESTRICT', 'RESTRICT');
	}

	public function safeDown()
	{
        $this->dropTable('chatban');
	}
	
}