<?php
/* @var $this CountriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Countries',
);

$this->menu=array(
	array('label'=>'Create Countries', 'url'=>array('create')),
	array('label'=>'Manage Countries', 'url'=>array('admin')),
);
?>

<h1>Countries</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
