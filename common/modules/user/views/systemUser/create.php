<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	UserModule::t('System Users')=>array('index'),
	UserModule::t('Create'),
);

$this->menu=array(
	array('label'=>UserModule::t('Manage System Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo UserModule::t('Create System User')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>