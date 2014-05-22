<?php
    /* @var $this MpversionsController */
    /* @var $model Mpversions */
?>

<?php
$this->breadcrumbs=array(
	'Mpversions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

    $this->menu=array(
    array('label'=>MpModule::t('List Mpversions'), 'url'=>array('index')),
    array('label'=>MpModule::t('Create Mpversions'), 'url'=>array('create')),
    array('label'=>MpModule::t('View Mpversions'), 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>MpModule::t('Manage Mpversions'), 'url'=>array('admin')),
    );
    ?>

    <h1><?php echo MpModule::t('Update Mpversions'); ?> <?php echo $model->id; ?></h1>
<?php $this->renderPartial('_addparams', array()); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>