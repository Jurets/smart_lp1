<?php
class ChatModule extends BaseModule
{
	// path to directory for upload files
	public $show = array('/chat');
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
        parent::init();
		// import the module-level models and components
		$this->setImport(array(
				'chat.models.*',
				'chat.components.*',
		));
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