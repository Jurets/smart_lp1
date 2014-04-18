<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs=array(
	'Requisites'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Requisites', 'url'=>array('index')),
	array('label'=>'Create Requisites', 'url'=>array('create')),
	array('label'=>'Update Requisites', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Requisites', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Requisites', 'url'=>array('admin')),
);
?>

<h1>View Requisites #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'details',
		'agreement',
		'marketing',
		'pw_supervisor',
		'pw_admin',
		'pw_moderator',
		'purse_activation',
		'purse_club',
		'purse_investor',
		'purse_fdl',
		'email_faq',
	),
)); ?>
