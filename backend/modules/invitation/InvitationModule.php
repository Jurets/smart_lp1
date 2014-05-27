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
}