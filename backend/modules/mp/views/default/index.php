<?php
/* @var $this MpversionsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Mpversions'),
);

$this->menu=array(
    array('label'=>BaseModule::t('rec','Create Version'),'url'=>array('create')),
    array('label'=>BaseModule::t('rec','Manage Mpversions'),'url'=>array('admin')),
);
?>

<h1>Mpversions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>