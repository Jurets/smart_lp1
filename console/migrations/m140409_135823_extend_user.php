<?php
/**
*  добавить новые структуры данных
*  - табл статусов (маркетинг план)
*  - поля участников (личные данные и т.п.)
*  - внешние ключи на имеющиеся таблицы
*/

class m140409_135823_extend_user extends ProjectMigration
{
	public function safeUp()
	{
        //добавить новые поля в табл юзеров
        $this->addColumn('tbl_users', 'refer_id', 'INT(11) DEFAULT NULL COMMENT "ид реферала"');
        $this->addColumn('tbl_users', 'first_name', 'VARCHAR(255) DEFAULT NULL COMMENT "имя"');
        $this->addColumn('tbl_users', 'last_name', 'VARCHAR(255) DEFAULT NULL COMMENT "фамилия"');
        $this->addColumn('tbl_users', 'dob', 'DATE DEFAULT NULL COMMENT "дата рождения"');
        $this->addColumn('tbl_users', 'city_id', 'INT(11) DEFAULT NULL COMMENT "ид города"');
        $this->addColumn('tbl_users', 'gmt_id', 'INT(11) DEFAULT NULL COMMENT "ид часового пояса"');
        $this->addColumn('tbl_users', 'phone', 'VARCHAR(20) DEFAULT NULL COMMENT "телефон"');
        $this->addColumn('tbl_users', 'skype', 'VARCHAR(255) DEFAULT NULL COMMENT "скайп"');
        $this->addColumn('tbl_users', 'photo', 'VARCHAR(255) DEFAULT NULL COMMENT "путь к файлу фото (аватарка)"');
        $this->addColumn('tbl_users', 'purse', 'VARCHAR(255) DEFAULT NULL COMMENT "кошелек W1"');
        $this->addColumn('tbl_users', 'active', 'TINYINT(1) NOT NULL COMMENT "активность юзера (0 - нет, 1 - да)"');
        $this->addColumn('tbl_users', 'activated', 'TIMESTAMP NULL DEFAULT NULL COMMENT "дата активации"');
        $this->addColumn('tbl_users', 'sys_lang', 'ENUM("ru", "en") NOT NULL DEFAULT "ru" COMMENT "язык диалогов и сообщений"');
        
        //добавить внешние ключи
        $this->addForeignKey('FK_cities_countries_id', 'cities', 'country_id', 'countries', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_users_cities', 'tbl_users', 'city_id', 'cities', 'id', 'RESTRICT', 'RESTRICT');
        //$this->addForeignKey('FK_users_refer', 'tbl_users', 'refer_id', 'tbl_users', 'id', 'RESTRICT', 'RESTRICT');
	}

	public function safeDown()
	{
        //$this->dropForeignKey('FK_users_refer', 'tbl_users');
        $this->dropForeignKey('FK_users_cities', 'tbl_users');
        $this->dropForeignKey('FK_cities_countries_id', 'cities');

        $this->dropColumn('tbl_users', 'first_name');
        $this->dropColumn('tbl_users', 'last_name');
        $this->dropColumn('tbl_users', 'dob');
        $this->dropColumn('tbl_users', 'city_id');
        $this->dropColumn('tbl_users', 'gmt_id');
        $this->dropColumn('tbl_users', 'phone');
        $this->dropColumn('tbl_users', 'skype');
        $this->dropColumn('tbl_users', 'photo');
        $this->dropColumn('tbl_users', 'purse');
        $this->dropColumn('tbl_users', 'refer_id');
        $this->dropColumn('tbl_users', 'active');
        $this->dropColumn('tbl_users', 'activated');
        $this->dropColumn('tbl_users', 'sys_lang');
}

}