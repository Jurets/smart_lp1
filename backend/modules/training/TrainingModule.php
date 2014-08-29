<?php

class TrainingModule extends CWebModule
{
    // path
    public $trainingShow = array('/training/training');
    public $uploadDir;
    public $uploadUrl = '/admin/uploads/';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'training.models.*',
			'training.components.*',
		));
	}

    /**
     * @param $str
     * @param $params
     * @param $dic
     * @return string
     */
    public static function t($str='',$params=array(),$dic='training') {
        if (Yii::t("TrainingModule", $str)==$str)
            return Yii::t("TrainingModule.".$dic, $str, $params);
        else
            return Yii::t("TrainingModule", $str, $params);
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
