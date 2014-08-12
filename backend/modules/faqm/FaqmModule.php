<?php

class FaqmModule extends CWebModule
{
        public $faqmShow = array('/faqm'); //для связи с главным меню
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'faqm.models.*',
			'faqm.components.*',
		));
	}

        /* localisation`s element */
        public static function t($str='',$params=array(),$dic='faqm') {
		if (Yii::t("faqm", $str)==$str)
			return Yii::t("faqmModule.".$dic, $str, $params);
		else
			return Yii::t("faqmModule", $str, $params);
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
