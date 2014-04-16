<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs=array(
	'Trainings'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List Training', 'url'=>array('index')),
	array('label'=>'Create Training', 'url'=>array('create')),
	array('label'=>'View Training', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Training', 'url'=>array('index')),
);
?>

<h1>Update Training <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>