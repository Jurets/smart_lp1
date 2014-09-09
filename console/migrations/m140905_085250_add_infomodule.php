<?php

class m140905_085250_add_infomodule extends CDbMigration
{
    public function up()
    {
        //таблица
        $this->createTable('info', array(
            'id'  => "VARCHAR(255) NOT NULL COMMENT 'ссылка'",
            'title' => "VARCHAR(255) NOT NULL COMMENT 'заголовок'",
            'text'  => "TEXT NOT NULL COMMENT 'текст в HTML-формате'",
            'PRIMARY KEY (id)',
            ), "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT = 'статические информационные страницы'"
        );
        //добавить строки
        $this->insert('info', array('id'=>'live', 'title'=>'Онлайн', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'news', 'title'=>'Новости', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'feedback', 'title'=>'Обратная связь', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'youtube', 'title'=>'канал YouTube', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('id'=>'aboutus', 'title'=>'О нас', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'aboutproject', 'title'=>'О проекте', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'partners', 'title'=>'Наши партнеры', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'bankdetails', 'title'=>'Связаться с нами и банковские реквизиты', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('id'=>'service', 'title'=>'Обслуживание', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'financial', 'title'=>'Финансовая помощь', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'bmachine', 'title'=>'Бизнес-машина', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'advert', 'title'=>'Совместная реклама', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'perswww', 'title'=>'Личный сайт', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'sms', 'title'=>'SMS-рассылки', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('id'=>'rules', 'title'=>'Правила', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'agreement', 'title'=>'Соглашение об участии', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'community', 'title'=>'Принципы сообщества', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'antispam', 'title'=>'Политика антиспама', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('id'=>'cooperation', 'title'=>'Сотрудничество', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'participants', 'title'=>'Участники', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'paysystems', 'title'=>'Платежныесистемы', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'exchangers', 'title'=>'Обменники', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'platforms', 'title'=>'Площади для рекламы', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'bereseller', 'title'=>'Стать реселлером', 'text'=>'Lorem Ipsum...'));
        
        $this->insert('info', array('id'=>'support', 'title'=>'Техподдержка', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'instructions', 'title'=>'Инструкции', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'forum', 'title'=>'Форум', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'contactus', 'title'=>'Связаться с нами', 'text'=>'Lorem Ipsum...'));
        
        
        $this->insert('info', array('id'=>'possibilities', 'title'=>'Возможности', 'text'=>'Lorem Ipsum...'));
        //$this->insert('info', array('id'=>'', 'title'=>'Правила', 'text'=>'Lorem Ipsum...'));
        $this->insert('info', array('id'=>'questions', 'title'=>'Вопросы и ответы', 'text'=>'Lorem Ipsum...'));
    }

    public function down()
    {
        $this->dropTable('info');
    }
}