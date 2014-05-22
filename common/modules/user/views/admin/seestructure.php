<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t("Participants structure", array(), 'participant'),
);

$this->menu=array(
    /*array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),*/
);

?>

<h1><?php echo UserModule::t("Participants structure", array(), 'participant'); ?></h1>

<?php 
$this->renderPartial('_index', array('model'=>$model));
?>
