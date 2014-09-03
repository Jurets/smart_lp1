<?php
    /* @var $this MpversionsController */
    /* @var $model Mpversions */
?>

<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Mpversions')=>array('index'),
	" ".$model->id=>array('view','id'=>$model->id),
	BaseModule::t('rec','Update'),
);

    $this->menu=array(
//    array('label'=>MpModule::t('List Mpversions'), 'url'=>array('index')),
    array('label'=>BaseModule::t('rec','Create Mpversions'), 'url'=>array('create')),
//    array('label'=>MpModule::t('View Mpversions'), 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>BaseModule::t('rec','Manage Mpversions'), 'url'=>array('admin')),
    );
    ?>

    <h1><?php echo BaseModule::t('rec','Update Mpversions'); ?> <?php echo $model->id; ?></h1>
<?php //$this->renderPartial('_addparams', array()); // отключено, см view create ?>
<?php $this->renderPartial('_form3', array('model'=>$model)); ?>