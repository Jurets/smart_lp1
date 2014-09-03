<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	BaseModule::t('rec','System Users')=>array('index'),
	BaseModule::t('rec','Create'),
);

$this->menu=array(
	array('label'=>BaseModule::t('rec','Manage System Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec','Create System User')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>