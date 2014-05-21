<?php
/* @var $this MpversionsController */
/* @var $model Mpversions */
?>

<?php
$this->breadcrumbs=array(
	'Mpversions'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>MpModule::t('List Mpversions'), 'url'=>array('index')),
array('label'=>MpModule::t('Create Mpversions'), 'url'=>array('create')),
array('label'=>MpModule::t('Update Mpversions'), 'url'=>array('update', 'id'=>$model->id)),
array('label'=>MpModule::t('Delete Mpversions'), 'url'=>MpModule::t('#'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>MpModule::t('Manage Mpversions'), 'url'=>array('admin')),
);
?>

<h1><?php echo MpModule::t('View Mpversions'); ?> <?php echo MpModule::t('#'); ?><?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
'htmlOptions' => array(
'class' => 'table table-striped table-condensed table-hover',
),
'data'=>$model,
'attributes'=>array(
		//'id',
		'description',
		'creationdate',
		'activity',
),
)); ?>
<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$model->attachDataProvider(),
    'columns'=>array('name', 'value'),
));
?>
