<?php

class m140905_001848_training_add_lng extends CDbMigration
{
	public function up()
	{
            $this->addColumn('training', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
	}

	public function down()
	{
            $this->dropColumn('training', 'lng');
	}

}