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

    /**
     * @param $str
     * @param $params
     * @param $dic
     * @return string
     */
    public static function t($str = '', $params = array(), $dic = 'news')
    {
        if (Yii::t("NewsModule", $str) == $str)
            return Yii::t("NewsModule." . $dic, $str, $params);
        else
            return Yii::t("NewsModule", $str, $params);
    }

}
