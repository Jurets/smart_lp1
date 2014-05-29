<?php
$this->breadcrumbs=array(
    UserModule::t('Unified database participants', array(), 'participant') => array('admin'),
	UserModule::t('Create'),
);

$this->menu=array(
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
?>
<h1><?php echo UserModule::t('New Participant', array(), 'participant'); ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,/*'profile'=>$profile*/));
?>