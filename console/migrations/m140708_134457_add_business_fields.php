<?php

class m140708_134457_add_business_fields extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{users}}', 'structcount', 'INT NOT NULL DEFAULT 0 AFTER refer_id');
        $this->addColumn('{{users}}', 'balance', 'FLOAT NOT NULL DEFAULT 0 AFTER refer_id');
	}

	public function safeDown()
	{
        $this->dropColumn('{{users}}', 'structcount');
        $this->dropColumn('{{users}}', 'balance');
	}
}