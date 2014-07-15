<?php

class m140715_091234_field_club_date extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{users}}', 'club_date', 'TIMESTAMP DEFAULT "0000-00-00 00:00:00" COMMENT "дата вхождения в клуб" AFTER busy_date');
	}

	public function down()
	{
		$this->dropColumn('{{users}}', 'club_date');
	}

}
