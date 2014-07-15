<?php

class m140715_120418_statistica_visitors extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{visits}}', array(
			'id'=>'int(11) NOT NULL AUTO_INCREMENT',
			'user_id'=>'INT(11) DEFAULT NULL COMMENT "внешний ключ к таблице tbl_users"',
			'date_visit'=>'TIMESTAMP DEFAULT "0000-00-00 00:00:00" COMMENT "дата захода на личную страницу пользователя"',
			'visits_count'=>'INT(11) DEFAULT NULL COMMENT "количество посещений личной страницы данного пользователя"',
			'PRIMARY KEY (id)',
		));
		$this->addForeignKey('fk_visits', 'tbl_visits', 'user_id', 'tbl_users', 'id', 'RESTRICT', 'RESTRICT');
		
	}

	public function down()
	{
		$this->dropForeignKey('fk_visits', '{{visits}}');
		$this->dropTable('{{visits}}');
	}

}
