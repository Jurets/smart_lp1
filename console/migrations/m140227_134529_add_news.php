<?php

class m140227_134529_add_news extends ProjectMigration
{
	public function up()
	{
        $this->createTable('news', array(
              'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
              'title' => 'VARCHAR(255) NOT NULL COMMENT "заголовок"',
              'text' => 'TEXT NOT NULL COMMENT "текст новости"',
              'image' => 'VARCHAR(255) NOT NULL COMMENT "картинка (путь к файлу)"',
              'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT "дата добавления"',
              'activated' => 'TIMESTAMP DEFAULT "0000-00-00 00:00:00" COMMENT "дата включения"',
              'PRIMARY KEY (id)'
          ), 
          $this->tableSqlOptions);
	}

	public function down()
	{
        $this->dropTable('news');
	}

}