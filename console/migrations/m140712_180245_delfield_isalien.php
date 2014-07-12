<?php

class m140712_180245_delfield_isalien extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('{{users}}', 'isalien');
        $this->dropColumn('{{users}}', 'structcount');
	}

	public function down()
	{
		echo "m140712_180245_delfield_isalien does not support migration down.\n";
		return false;
	}
}