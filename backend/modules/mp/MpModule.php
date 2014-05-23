<?php

class MpModule extends CWebModule
{
        public $mpShow = array('/mp');
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'mp.models.*',
			'mp.components.*',
		));
	}

        /* localisation`s element */
        public static function t($str='',$params=array(),$dic='mp') {
		if (Yii::t("mp", $str)==$str)
			return Yii::t("mpModule.".$dic, $str, $params);
		else
			return Yii::t("mpModule", $str, $params);
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
