<?php
$this->breadcrumbs=array(
    BaseModule::t('rec','Unified database participants', array(), 'participant') => array('admin'),
	UserModule::t('Create'),
);

$this->menu=array(
    array('label'=>BaseModule::t('rec','Manage Users'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>BaseModule::t('rec','List User'), 'url'=>array('/user')),
);
?>
<h1><?php echo BaseModule::t('rec','New Participant', array(), 'participant'); ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,/*'profile'=>$profile*/));
?>