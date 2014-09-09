<?php

class InfoModule extends BaseModule
{
    public $requisitesShow = array('/info');

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
        parent::init();
		// import the module-level models and components
		$this->setImport(array(
			'info.models.*',
			'info.components.*',
		));
	}
}
