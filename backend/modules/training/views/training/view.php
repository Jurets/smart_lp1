<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs=array(
	'Trainings'=>array('index'),
	$model->title,
);

$this->menu=array(
//	array('label'=>'List Training', 'url'=>array('index')),
	array('label'=>'Create Training', 'url'=>array('create')),
	array('label'=>'Update Training', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Training', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Training', 'url'=>array('index')),
);
?>

<h1>View Training #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',

		array(
            'name'=>'image',
            'type' => 'html',
            'value'=>TbHtml::image($model->image),
        ),

        'videolink',
		'date',
		'number',
	),
)); ?>
