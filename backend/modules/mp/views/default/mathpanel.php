<?php
$this->menu=array(
    array('label'=>BaseModule::t('rec','Create Version'),'url'=>array('create')),
    array('label'=>BaseModule::t('rec','Manage Mpversions'),'url'=>array('admin')),
);

 ?>

<?php $this->breadcrumbs=array(
	BaseModule::t('rec','Mpversions')=>array('index'),
	BaseModule::t('rec','Index Management'),
); 
?>
<?php if (is_null($model->getAttribute('id'))) { ?>
    <h1><?php echo BaseModule::t('rec','No Versions'); ?></h1>
<?php } else { ?>
    <h1><?php echo BaseModule::t('rec','Current version'); ?></h1>
<?php $this->renderPartial('_addparams', array()); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php } ?>