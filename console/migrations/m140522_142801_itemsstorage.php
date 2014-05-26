<?php

class m140522_142801_itemsstorage extends CDbMigration
{
	public function up()
	{		
		$this->createTable('itemsstorage', array(
			'item'=>'varchar(255) not null',
			'content'=>'text',
			'PRIMARY KEY (`item`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8;'
		);
	}

	public function down()
	{
		$this->dropTable('itemsstorage');
	}
}
