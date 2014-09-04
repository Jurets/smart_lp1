<?php
    /* @var $this MpversionsController */
    /* @var $model Mpversions */
?>

<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Mpversions')=>array('index'),
	BaseModule::t('rec','Create'),
);

    $this->menu=array(
    //array('label'=>'List Mpversions', 'url'=>array('index')),
    array('label'=>BaseModule::t('rec','Manage Mpversions'), 'url'=>array('admin')),
    );
    ?>

<h1><?php echo BaseModule::t('rec','Create Mpversions'); ?></h1>
<?php //$this->renderPartial('_addparams', array()); // добавление параметров посредством js выключено, количество математических параметров фиксировано ?>
<?php $this->renderPartial('_form3', array('model'=>$model)); ?>