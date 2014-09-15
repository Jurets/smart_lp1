<?php

class m140915_084336_add_info_lng extends CDbMigration
{
	public function safeUp()
	{
        //очистить таблицу (удалить строки)
        //$this->truncateTable('info');
        //$this->execute('ALTER TABLE info DROP PRIMARY KEY');
        //$this->dropColumn('info', 'id');
        //поменять ПК на числовой
        //$this->addColumn('info', 'id', 'INT(11) NOT NULL AUTO_INCREMENT');
        //добавить столбцы языка и название
        //$this->addColumn('info', 'lng', 'varchar(3) DEFAULT NULL COMMENT "язык" AFTER id');
        //$this->addColumn('info', 'name', 'varchar(3) DEFAULT NULL COMMENT "название" AFTER lng');
        //определить ПК
        //$this->addPrimaryKey('PK_info', 'info', 'id');

        $this->dropTable('info');
        $this->createTable('info', array(
            'id'   => "INT(11) NOT NULL AUTO_INCREMENT",
            'lng'  => "VARCHAR(3) DEFAULT NULL COMMENT 'язык'",
            'name' => "VARCHAR(255) NOT NULL COMMENT 'ссылка'",
            'title'=> "VARCHAR(255) NOT NULL COMMENT 'заголовок'",
            'text' => "TEXT NOT NULL COMMENT 'текст в HTML-формате'",
            'PRIMARY KEY (id)',
            ), "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT = 'статические информационные страницы'"
        );
        
        //$this->update('info', array('lng'=>'ru'));
        
        //добавить строки
        $this->insert('info', array('lng'=>'ru', 'name'=>'live', 'title'=>'Онлайн', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'news', 'title'=>'Новости', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'feedback', 'title'=>'Обратная связь', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'youtube', 'title'=>'канал YouTube', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('lng'=>'ru', 'name'=>'aboutus', 'title'=>'О нас', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'aboutproject', 'title'=>'О проекте', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'partners', 'title'=>'Наши партнеры', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'bankdetails', 'title'=>'Связаться с нами и банковские реквизиты', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('lng'=>'ru', 'name'=>'service', 'title'=>'Обслуживание', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'financial', 'title'=>'Финансовая помощь', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'bmachine', 'title'=>'Бизнес-машина', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'advert', 'title'=>'Совместная реклама', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'perswww', 'title'=>'Личный сайт', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'sms', 'title'=>'SMS-рассылки', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('lng'=>'ru', 'name'=>'rules', 'title'=>'Правила', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'agreement', 'title'=>'Соглашение об участии', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'community', 'title'=>'Принципы сообщества', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'antispam', 'title'=>'Политика антиспама', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('lng'=>'ru', 'name'=>'cooperation', 'title'=>'Сотрудничество', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'participants', 'title'=>'Участники', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'paysystems', 'title'=>'Платежные системы', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'exchangers', 'title'=>'Обменники', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'platforms', 'title'=>'Площади для рекламы', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'bereseller', 'title'=>'Стать реселлером', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('lng'=>'ru', 'name'=>'support', 'title'=>'Техподдержка', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'instructions', 'title'=>'Инструкции', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'forum', 'title'=>'Форум', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'contactus', 'title'=>'Связаться с нами', 'text'=>'Lorem Ipsum...'));
        
        
        $this->insert('info', array('lng'=>'ru', 'name'=>'possibilities', 'title'=>'Возможности', 'text'=>'Lorem Ipsum...'));
      //$this->insert('info', array('lng'=>'ru', 'name'=>'', 'title'=>'Правила', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('lng'=>'ru', 'name'=>'questions', 'title'=>'Вопросы и ответы', 'text'=>'Lorem Ipsum...'));
        
	}

	public function safeDown()
	{
         echo "m140905_085250_add_infomodule does not support migration down.\n";
         return false;
	}
}