<?php

class m140718_082519_yii_chat_list extends CDbMigration
{

    public function up()
    {

        $this->createTable('yiichat_list', array(
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            'id_user' => 'INT(11) NOT NULL',
            'id_user_invited' => 'INT(11) NOT NULL',
            'PRIMARY KEY (id)',
                ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
        );
        $this->addForeignKey('fk_yiichat_list_id_ser', 'yiichat_list', 'id_user', '{{users}}', 'id');
    }

    public function down()
    {
        $this->dropTable('yiichat_list');
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
