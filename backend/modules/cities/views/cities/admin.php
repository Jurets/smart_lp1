<?php
/* @var $this CitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cities',
);

$this->menu=array(
	array('label'=>'Create Cities', 'url'=>array('create')),
	array('label'=>'Manage Cities', 'url'=>array('index')),
);
?>

<h1>Cities</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
