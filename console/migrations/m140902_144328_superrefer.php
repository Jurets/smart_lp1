<?php

class m140902_144328_superrefer extends ProjectMigration
{
	public function safeUp()
	{
        $this->addColumn('requisites', 'superrefer_id', 'INT(11) DEFAULT NULL COMMENT "ид супер-реферала"');
        $this->addForeignKey('FK_superrefer', 'requisites', 'superrefer_id', 'tbl_users', 'id', 'RESTRICT', 'RESTRICT');
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_superrefer', 'requisites');
        $this->dropColumn('requisites', 'superrefer_id');
	}
}