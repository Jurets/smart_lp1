<?php

class NewsModule extends BaseModule
{

    // path to directory for upload files
    public $newsShow = array('/news');
    public $dictionary = 'news';
    public $uploadDir;

    public function init()
    {
        parent::init();
        // import the module-level models and components
        $this->setImport(array(
            'news.models.*',
            'news.components.*',
        ));
    }

}
