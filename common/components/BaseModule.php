<?php

class BaseModule extends CWebModule {

    // path to directory for upload files
    public $uploadDir;
    public $uploadUrl;

    //public $dictionary = 'default';

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        //$this->setImport(array(
        //		'news.models.*',
        //		'news.components.*',
        //));

        $this->uploadDir = Yii::app()->params['upload.path'];
        $this->uploadUrl = Yii::app()->params['upload.url'];
    }

    /**
     * @param $str
     * @param $params
     * @param $dic
     * @return string
     */
    //public static function t($dic, $str='', $params=array(), $dic='default') {DebugBreak();
    public static function t($dic = 'rec', $str = '', $params = array()) {//DebugBreak();
        //$dic = !empty($dic) ? $dic : $this->dictionary;
        /* $moduleName = get_called_class(); //__CLASS__; $this->name
          if (Yii::t($moduleName, $str)==$str)
          return Yii::t($moduleName.".".$dic, $str, $params);
          else
          return Yii::t($moduleName, $str, $params); */

        $trans = Yii::t($dic, $str, $params);
        if ($trans == $str && Yii::app()->language != 'en') {
            $res = Yii::t('rec', $str, $params, null /* Yii::app()->messages */, 'ru');
        } else {
            $res = $trans;
        }
        return $res;
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

    /* Коррекция работы по субдоменам */
    /* получение субдоменного url - домен передаетсфя параметром */
    public static function createAssembledUrl($domain) {
        //$host = $_SERVER['HTTP_HOST'];
        $host = Yii::app()->params['host.name'];
        $protocol = $_SERVER['SERVER_PROTOCOL'];
        $protocolPrefix = strtolower(explode('/', $protocol)[0]) . '://';
        return $protocolPrefix . $domain . '.' . $host;
    }
    // вычисление юзера по его поддомену - проверка субдомена - по empty()
    public static function getUserFromSubdomain(){
        $host = $_SERVER['HTTP_HOST'];
        if(!strpos($host, '.')) { 
            return [];
        }
        $hostParts = explode('.', $host);
        if(count($hostParts) === 3){ /* 2 on real serv in my localhost - http://test.jm is 2*/
            return $hostParts[0]; 
        }
        
                return [];
    }    
    // проверка на существование поддомена пользователя
    public static function checkSubdomainExistence(){
        $host = $_SERVER['HTTP_HOST'];
        $host_pieces = explode('.', $host);
        if( count($host_pieces) === 3) { // subdomain exists
            $model = Participant::model()->find('username=:username', array(':username'=>$host_pieces[0]));
            if(empty($model)) {
                $redirectUrl = "http://".Yii::app()->params['host.name'];
                Yii::app()->getRequest()->redirect($redirectUrl);
            }
            return TRUE;
        }
        return TRUE;
    }
}
