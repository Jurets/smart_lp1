<?php
    /* @var $this MpversionsController */
    /* @var $model Mpversions */
?>

<?php
$this->breadcrumbs=array(
	'Mpversions'=>array('index'),
	'Create',
);

    $this->menu=array(
    array('label'=>'List Mpversions', 'url'=>array('index')),
    array('label'=>'Manage Mpversions', 'url'=>array('admin')),
    );
    ?>

<h1><?php echo MpModule::t('Create Mpversions'); ?></h1>
<?php $this->renderPartial('_addparams', array()); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>