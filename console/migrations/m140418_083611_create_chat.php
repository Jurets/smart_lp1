<?php

class m140418_083611_create_chat extends ProjectMigration
{
	public function up()
	{
        $this->createTable('yiichat_post', array(
              'id'=>'CHAR(40) NOT NULL DEFAULT ""',
              'chat_id'=>'CHAR(40) DEFAULT NULL',
              'post_identity'=>'CHAR(40) DEFAULT NULL',
              'owner'=>'CHAR(20) DEFAULT NULL',
              'created'=>'BIGINT(30) DEFAULT NULL',
              'text'=>'BLOB DEFAULT NULL',
              'data'=>'BLOB DEFAULT NULL',
              'is_alert'=>'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "флаг - важное сообщение"',
              'PRIMARY KEY (id)',
              'INDEX yiichat_chat_id (chat_id)',
              'INDEX yiichat_chat_id_identity (chat_id, post_identity)'
            ),
            $this->tableSqlOptions
        );
    }

	public function down()
	{
		$this->dropTable('yiichat_post');
	}

}