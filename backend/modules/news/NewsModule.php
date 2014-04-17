<?php
class NewsModule extends CWebModule
{
	// path to directory for upload files
	public $uploadDir;
	public $uploadUrl;
	public $newsShow = array('/news/news');
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
				'news.models.*',
				'news.components.*',
		));
		//Yii::setPathOfAlias('news.uploads', Yii::app()->basePath .DIRECTORY_SEPARATOR.'www'.DIRECTORY_SEPARATOR. 'uploads');
		$this->uploadDir = Yii::app()->params['upload.path'];
		$this->uploadUrl = Yii::app()->params['upload.url'];
	}

	/**
	 * @param $str
	 * @param $params
	 * @param $dic
	 * @return string
	 */
	public static function t($str='',$params=array(),$dic='news') {
		if (Yii::t("NewsModule", $str)==$str)
			return Yii::t("NewsModule.".$dic, $str, $params);
		else
			return Yii::t("NewsModule", $str, $params);
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