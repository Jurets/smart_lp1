<?php

class m140903_163228_news_langmutation extends CDbMigration
{
	public function up()
	{
            $this->addColumn('news', 'lng', 'varchar(2) DEFAULT NULL COMMENT "Язык контента" AFTER id');
	}

	public function down()
	{
            $this->dropColumn('news', 'lng');
	}

}