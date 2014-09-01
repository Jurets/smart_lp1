<?php

class m140819_110207_languages_database extends CDbMigration
{
	public function up()
	{
            $this->createTable('SourceMessage', array(
                'id' => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'счетчик записей'",
                'category' => "VARCHAR(32) DEFAULT 'rec' COMMENT 'категория'",
                'message' => "TEXT DEFAULT NULL COMMENT 'оригинал сообщения'",
                'PRIMARY KEY (id)',
            ));
            $this->createTable('Languages', array(
                'lang' => "VARCHAR(32) NOT NULL COMMENT'аббревиатура языка'",
                'name' => "VARCHAR(35) DEFAULT NULL COMMENT 'название языка'",
                'PRIMARY KEY (lang)',
            ));
            $this->createTable('Message', array(
                'id' => "INT(11) NOT NULL COMMENT 'для связи с оригиналами сообщений'",
                'language' => "VARCHAR(32) NOT NULL COMMENT 'аббревиатура языка'",
                'translation' => "TEXT DEFAULT NULL COMMENT 'перевод сообщения'",
                'PRIMARY KEY (id, language)',
                'CONSTRAINT FK_Message_SourceMessage FOREIGN KEY(id) REFERENCES SourceMessage (id) ON DELETE CASCADE ON UPDATE RESTRICT',
                'CONSTRAINT FK_Message_Languages FOREIGN KEY(language) REFERENCES Languages (lang) ON DELETE CASCADE ON UPDATE RESTRICT',
            )
                    //,'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
                    );
            Yii::import('common.components.LangDefaultInstall');
            LangDefaultInstall::install();
            
	}

	public function down()
	{
            $this->dropTable('Message');
            $this->dropTable('SourceMessage');
            $this->dropTable('Languages');
	}

}

/*
  CREATE TABLE SourceMessage
    (
        id INTEGER PRIMARY KEY,
        category VARCHAR(32),
        message TEXT
    );
    CREATE TABLE Message
    (
        id INTEGER,
        language VARCHAR(16),
        translation TEXT,
        PRIMARY KEY (id, language),
        CONSTRAINT FK_Message_SourceMessage FOREIGN KEY (id)
             REFERENCES SourceMessage (id) ON DELETE CASCADE ON UPDATE RESTRICT
    ); 
 */