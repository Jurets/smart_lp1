<?php
class CountriesModule extends CWebModule
{
	// path
	public $countriesShow = array('/countries/countries');
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
				'countries.models.*',
				'countries.components.*',
		));
	}

	/**
	 * @param $str
	 * @param $params
	 * @param $dic
	 * @return string
	 */
	public static function t($str='',$params=array(),$dic='countries') {
		if (Yii::t("CountriesModule", $str)==$str)
			return Yii::t("CountriesModule.".$dic, $str, $params);
		else
			return Yii::t("CountriesModule", $str, $params);
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