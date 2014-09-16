<?php
/* @var $this MpversionsController */
/* @var $model Mpversions */
?>

<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Mpversions')=>array('index'),
	$model->description,
);

$this->menu=array(
    array('label'=>BaseModule::t('rec','List Mpversions'), 'url'=>array('index')),
    array('label'=>BaseModule::t('rec','Create Mpversions'), 'url'=>array('create')),
    array('label'=>BaseModule::t('rec','Update Mpversions'), 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>BaseModule::t('rec','Delete Mpversions'), 'url'=>MpModule::t('#'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>BaseModule::t('rec','Are you sure you want to delete this item?'))),
    array('label'=>BaseModule::t('rec','Manage Mpversions'), 'url'=>array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec','View Mpversions'); ?> <?php echo BaseModule::t('rec','#'); ?><?php echo $model->id; ?></h1>

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
    'columns'=>array(
        array('name'=>'name', 'value'=>'$data->lng_name[$data->name]'),
        array('name'=>'value', 'value'=>'$data->value'),
        ),
));
?>
