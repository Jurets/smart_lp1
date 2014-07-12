<?php

class m140712_094532_field_busy_date extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{users}}', 'busy_date', 'TIMESTAMP DEFAULT "0000-00-00 00:00:00" COMMENT "дата, когда стал бизнес-участником (оплатил 50$)" AFTER isalien');
	}

	public function down()
	{
		$this->dropColumn('{{users}}', 'busy_date');
	}
}