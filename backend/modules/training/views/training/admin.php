<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Trainings',
);

$this->menu=array(
	array('label'=>'Create Training', 'url'=>array('create')),
	array('label'=>'Manage Training', 'url'=>array('index')),
);
?>

<h1>Trainings</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
