<?php
class CommonstatModule extends CWebModule {
    
    
    public $commonstatShow = array('/commonstat'); // для связи с главнымм меню
    public function init() {
        parent::init();
        $this->setImport(array(
            'commonstat.models.*',
            'commonstat.components.*',
        ));
    }
     
    public static function t($str='',$params=array(),$dic='commonstat') {
	if (Yii::t("commonstat", $str)==$str)
		return Yii::t("commonstatModule.".$dic, $str, $params);
	else
		return Yii::t("commonstatModule", $str, $params);
    }
    
    public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
} 

