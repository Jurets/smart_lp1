<?php
class m140227_125147_add_requisites extends ProjectMigration
{
    public function up()
    {
        $this->createTable('requisites', array(
              'id' => 'VARCHAR(50) NOT NULL DEFAULT "JVMS"',
              'details' => 'TEXT DEFAULT NULL COMMENT "текст о проекте"',
              'agreement' => 'TEXT DEFAULT NULL COMMENT "текст договора оферты"',
              'marketing' => 'TEXT DEFAULT NULL COMMENT "текст маркетинг-плана"',
              'pw_supervisor' => 'VARCHAR(20) DEFAULT NULL COMMENT "пароль суперадмина"',
              'pw_admin' => 'VARCHAR(20) DEFAULT NULL COMMENT "пароль админа"',
              'pw_moderator' => 'VARCHAR(20) DEFAULT NULL COMMENT "пароль модератора"',
              'purse_activation' => 'VARCHAR(255) DEFAULT NULL COMMENT "номер кошелька активаций"',
              'purse_club' => 'VARCHAR(255) DEFAULT NULL COMMENT "номер оборотного кошелька БизнесКлуба"',
              'purse_investor' => 'VARCHAR(255) DEFAULT NULL COMMENT "призовой кошелек для инвесторов"',
              'purse_fdl' => 'VARCHAR(255) DEFAULT NULL COMMENT "номер кошелька FDL"',
              'email_faq' => 'TEXT DEFAULT NULL COMMENT "емейлы для FAQ"',
              'PRIMARY KEY (id)'
          ), 
          'ENGINE=InnoDB CHARSET=utf8');
    }

    public function down()
    {
        $this->dropTable('requisites');
    }

}