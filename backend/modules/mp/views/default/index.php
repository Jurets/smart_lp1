<?php
/* @var $this MpversionsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Mpversions',
);

$this->menu=array(
array('label'=>'Create Mpversions','url'=>array('create')),
array('label'=>'Manage Mpversions','url'=>array('admin')),
);
?>

<h1>Mpversions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>