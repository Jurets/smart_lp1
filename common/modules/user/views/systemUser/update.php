<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	'System Users'=>array('index'),
	" ".$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SystemUser', 'url'=>array('index')),
	array('label'=>'Create SystemUser', 'url'=>array('create')),
	array('label'=>'View SystemUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SystemUser', 'url'=>array('admin')),
);
?>

<h1><?php echo UserModule::t('Update System User') ?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>