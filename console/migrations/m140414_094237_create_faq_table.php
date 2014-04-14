<?php

class m140414_094237_create_faq_table extends ProjectMigration
{

    public function up()
    {
        $this->createTable('faq', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'question' => 'text',
            'answer' => 'text',
            'created' => 'date DEFAULT NULL',
            'id_user' => 'int(11) DEFAULT NULL',
            'category' => 'varchar(64) DEFAULT NULL',
            'PRIMARY KEY (id)'
        ),
                $this->tableSqlOptions);
    }

    public function down()
    {
        $this->dropTable('faq');
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
