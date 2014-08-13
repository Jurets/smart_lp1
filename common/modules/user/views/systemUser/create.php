<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	'System Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SystemUser', 'url'=>array('index')),
	array('label'=>'Manage SystemUser', 'url'=>array('admin')),
);
?>

<h1>Create SystemUser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>