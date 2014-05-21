<?php
$this->menu=array(
	array('label'=>'Create Mpversions', 'url'=>array('create')),
	array('label'=>'Manage Mpversions', 'url'=>array('admin')),
);

 ?>

<?php $this->breadcrumbs=array(
	'Mpversions'=>array('index'),
	'Index',
); 
?>
<?php if( is_null($model->getAttribute('id')) ) { ?>
<h1>No Versions</h1>
<?php }else{ ?>
<h1>Current version</h1>
<?php $this->renderPartial('_addparams', array()); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php } ?>