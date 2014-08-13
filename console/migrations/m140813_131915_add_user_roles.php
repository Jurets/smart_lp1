<?php

class m140813_131915_add_user_roles extends CDbMigration
{
	public function up()
	{
            $this->addColumn('{{users}}', 'roles', 'INT(1) DEFAULT NULL COMMENT "роли пользователей" AFTER superuser' );
	}

	public function down()
	{
            $this->dropColumn('{{users}}', 'roles');
	}

}