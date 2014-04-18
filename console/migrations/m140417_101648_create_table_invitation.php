<?php

class m140417_101648_create_table_invitation extends ProjectMigration
{

    public function up()
    {
        $this->createTable('invitation', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT COMMENT "id приглашения"',
            'video_link' => 'varchar(255) NOT NULL COMMENT "категория виджета()"',
            'file' => 'varchar(255) NOT NULL COMMENT "ссылка на файл(на сервере)"',
            'file_link' => 'varchar(255) NOT NULL COMMENT "ссылка на файл(на удаленном сервере)"',
            'created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "время создания приглашения"',
            'PRIMARY KEY (id)',
        ),
        $this->tableSqlOptions);
    }

    public function down()
    {
        $this->dropTable('invitation');
//        echo "m140417_101648_create_table_invitation does not support migration down.\n";
//        return false;
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
