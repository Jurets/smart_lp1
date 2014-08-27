<?php

class m140826_175405_cities_reload extends ProjectMigration
{
	public function up()
	{
            $this->execute('UPDATE `tbl_users` SET city_id=NULL');
            $this->dropForeignKey('FK_cities_countries_id', 'cities');
            $this->dropForeignKey('FK_users_cities', 'tbl_users');
            $this->truncateTable('cities');
            $this->truncateTable('countries');
            $this->addColumn('cities', 'name_en', 'varchar(255)	NOT NULL');
            $this->addColumn('countries', 'name_en', 'varchar(255) DEFAULT NULL AFTER name');
            $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cities2.sql');
            $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cities3.sql');
            $this->addForeignKey('FK_cities_countries_id', 'cities', 'country_id', 'countries', 'id', 'RESTRICT', 'RESTRICT');
            $this->addForeignKey('FK_users_cities', 'tbl_users', 'city_id', 'cities', 'id', 'RESTRICT', 'RESTRICT');
	}

	public function down()
	{
            $this->dropForeignKey('FK_cities_countries_id', 'cities');
            $this->dropForeignKey('FK_users_cities', 'tbl_users');
            $this->truncateTable('cities');
            $this->truncateTable('countries');
            $this->dropColumn('cities', 'name_en');
            $this->dropColumn('countries', 'name_en');
            $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cities.sql');
            $this->addForeignKey('FK_cities_countries_id', 'cities', 'country_id', 'countries', 'id', 'RESTRICT', 'RESTRICT');
            $this->addForeignKey('FK_users_cities', 'tbl_users', 'city_id', 'cities', 'id', 'RESTRICT', 'RESTRICT');
	}
        
}