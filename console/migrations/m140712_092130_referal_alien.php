<?php

class m140712_092130_referal_alien extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{users}}', 'isalien', 'INT(1) NOT NULL DEFAULT 0 COMMENT "флаг чужой приглашенный (0-нет,1-да)" AFTER refer_id');
	}

	public function down()
	{
		$this->dropColumn('{{users}}', 'isalien');
	}
}