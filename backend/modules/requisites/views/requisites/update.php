<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs=array(
	'Requisites'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Requisites', 'url'=>array('index')),
	array('label'=>'Create Requisites', 'url'=>array('create')),
	array('label'=>'View Requisites', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Requisites', 'url'=>array('admin')),
);
?>

<h1>Update Requisites <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>