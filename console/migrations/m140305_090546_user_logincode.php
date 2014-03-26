<?php

class m140305_090546_user_logincode extends CDbMigration
{
	public function up()
	{
        $this->addColumn(Yii::app()->getModule('user')->tableUsers, 'logincode', 'VARCHAR(128) NOT NULL DEFAULT ""');
	}

	public function down()
	{
		$this->addColumn(Yii::app()->getModule('user')->tableUsers, 'logincode');
	}

}