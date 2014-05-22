<?php

class ImModule extends CWebModule
{
        public $imShow = array('/im'); //для связи с главным меню 
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'im.models.*',
			'im.components.*',
		));
	}

        /* Элемент русификации*/
        public static function t($str='',$params=array(),$dic='im') {
		if (Yii::t("im", $str)==$str)
			return Yii::t("imModule.".$dic, $str, $params);
		else
			return Yii::t("imModule", $str, $params);
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
