<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs=array(
	'Requisites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Requisites', 'url'=>array('admin')),
	array('label'=>'Manage Requisites', 'url'=>array('index')),
);
?>

<h1>Create Requisites</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>