<?php
class ChatModule extends CWebModule
{
	// path to directory for upload files
	public $show = array('/chat');
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
				'chat.models.*',
				'chat.components.*',
		));
	}

	/**
	 * @param $str
	 * @param $params
	 * @param $dic
	 * @return string
	 */
	public static function t($str='',$params=array(),$dic='chat') {
		if (Yii::t("ChatModule", $str)==$str)
			return Yii::t("ChatModule.".$dic, $str, $params);
		else
			return Yii::t("ChatModule", $str, $params);
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