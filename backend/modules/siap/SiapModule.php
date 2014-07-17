<?php
class SiapModule extends CWebModule {
    public $imShow = array('/siap'); //для связи с главным меню 
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'siap.models.*',
			'siap.components.*',
		));
	}

        /* localisation`s element */
        public static function t($str='',$params=array(),$dic='im') {
		if (Yii::t("siap", $str)==$str)
			return Yii::t("siapModule.".$dic, $str, $params);
		else
			return Yii::t("siapModule", $str, $params);
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
