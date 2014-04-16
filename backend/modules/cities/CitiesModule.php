<?php

class CitiesModule extends CWebModule
{
    public $citiesShow = array('/cities/cities');

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'cities.models.*',
			'cities.components.*',
		));
	}

    /**
     * @param $str
     * @param $params
     * @param $dic
     * @return string
     */
    public static function t($str='',$params=array(),$dic='cities') {
        if (Yii::t("CitiesModule", $str)==$str)
            return Yii::t("CitiesModule.".$dic, $str, $params);
        else
            return Yii::t("CitiesModule", $str, $params);
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
