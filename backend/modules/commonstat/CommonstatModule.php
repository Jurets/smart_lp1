<?php
class CommonstatModule extends BaseModule {
    
    
    public $commonstatShow = array('/commonstat'); // для связи с главнымм меню
    public function init() {
        parent::init();
        $this->setImport(array(
            'commonstat.models.*',
            'commonstat.components.*',
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

