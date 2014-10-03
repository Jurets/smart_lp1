<?php

class m141003_081348_alter_table_users extends CDbMigration
{

    public function up()
    {
        $this->alterColumn('{{users}}', 'sys_lang', 'varchar (255)');
    }

    public function down()
    {
       
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
