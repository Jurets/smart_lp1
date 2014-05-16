<?php
/* @var $this RequisitesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Requisites',
);

$this->menu=array(
	array('label'=>'Create Requisites', 'url'=>array('create')),
	array('label'=>'Manage Requisites', 'url'=>array('index')),
);
?>

<h1>Requisites</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
