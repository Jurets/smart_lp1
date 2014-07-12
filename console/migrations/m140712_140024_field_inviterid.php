<?php

class m140712_140024_field_inviterid extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{users}}', 'inviter_id', 'INT(11) DEFAULT NULL COMMENT "ид пригласившего" AFTER refer_id');
        $this->addColumn('{{users}}', 'invite_num', 'INT(11) DEFAULT NULL COMMENT "номер в списке приглашеных" AFTER inviter_id');
	}

	public function down()
	{
		$this->dropColumn('{{users}}', 'inviter_id');
        $this->dropColumn('{{users}}', 'invite_num');
	}
}