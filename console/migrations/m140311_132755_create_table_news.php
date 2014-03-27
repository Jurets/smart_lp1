<?php

class m140311_132755_create_table_news extends CDbMigration
{
	public function up()
	{
		$this->dropTable('news');
		$this->createTable('news',
				array('id' => 'int(11) NOT NULL AUTO_INCREMENT',
						'author' => 'int(11) NOT NULL',
						'created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
						'activated' => 'timestamp NULL DEFAULT NULL',
						'title' => 'varchar(75) DEFAULT NULL',
						'announcement' => 'varchar(255) DEFAULT NULL',
						'content' => 'text',
						'image' => 'varchar(255) DEFAULT NULL',
						'activity' => "tinyint(1) NOT NULL DEFAULT '1'",
						'PRIMARY KEY (id)'
					),
				 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'  );
	}

	public function down()
	{
		$this->dropTable('news');
// 		echo "m140311_132755_create_table_news does not support migration down.\n";
// 		return false;
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