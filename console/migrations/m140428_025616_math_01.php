<?php

class m140428_025616_math_01 extends CDbMigration
{
	public function up()
	{
            $this->createTable('mpversions', array(
              'id'=>'int(11) not null auto_increment',
              'description'=>'varchar(255)',
              'creationdate'=>'timestamp not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP',
              'activity'=>'int(1) default 0',
              'PRIMARY KEY (`id`)'
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;');
            $this->createTable('mathparams', array(
              'id'=>'int(11) not null auto_increment',
              'name'=>'varchar(255)',
              'value'=>'varchar(255)',
              'verid'=>'int(11) not null',
              'PRIMARY KEY (`id`)',
              'KEY `verid` (`verid`)',
              'FOREIGN KEY (`verid`) REFERENCES `mpversions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE'
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;');
	}

	public function down()
	{
            $this->dropTable('mathparams');
            $this->dropTable('mpversions');
	}
}