<?php

class m150515_143152_add_autoclub_status_into_participant extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tbl_users', 'autoclub', 'INT(3) DEFAULT 0 COMMENT "" AFTER club_date');
	}

	public function down()
	{
            $this->dropColumn('tbl_users', 'autoclub');
	}

}