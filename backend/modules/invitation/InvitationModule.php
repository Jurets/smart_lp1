<?php
class InvitationModule extends BaseModule
{
	// path
	public $invitationShow = array('/invitation');
    
	public function init()
	{
		parent::init();
		// import the module-level models and components
		$this->setImport(array(
				'invitation.models.*',
				'invitation.components.*',
		));
	}
    /* localisation`s element */
    public static function t($str='',$params=array(),$dic='invitation') {
        if (Yii::t("invitation", $str)==$str)
            return Yii::t("InvitationModule.".$dic, $str, $params);
        else
            return Yii::t("InvitationModule", $str, $params);
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