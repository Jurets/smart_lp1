<?php

class m140414_120312_training extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_training',
            array(
                  'id'=> 'int(11) NOT NULL AUTO_INCREMENT',
                  'title'=> 'varchar(255) NOT NULL',
                  'description'=> 'text NOT NULL',
                  'image'=> 'varchar(255) NOT NULL',
                  'videolink'=> 'varchar(255) NOT NULL',
                  'date'=> 'datetime NOT NULL',
                  'number'=> 'int(11) DEFAULT NULL',
                  'PRIMARY KEY (`id`)'
            ),
            'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'  );
	}

	public function down()
	{
        $this->dropTable('tbl_training');
//		echo "m140414_120312_training does not support migration down.\n";
//		return false;
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