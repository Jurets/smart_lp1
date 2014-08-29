<?php
    /* @var $this MpversionsController */
    /* @var $model Mpversions */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('rec','Mpversions')=>array('index'),
	" ".$model->id=>array('view','id'=>$model->id),
	Yii::t('rec','Update'),
);

    $this->menu=array(
//    array('label'=>MpModule::t('List Mpversions'), 'url'=>array('index')),
    array('label'=>Yii::t('rec','Create Mpversions'), 'url'=>array('create')),
//    array('label'=>MpModule::t('View Mpversions'), 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>Yii::t('rec','Manage Mpversions'), 'url'=>array('admin')),
    );
    ?>

    <h1><?php echo Yii::t('rec','Update Mpversions'); ?> <?php echo $model->id; ?></h1>
<?php //$this->renderPartial('_addparams', array()); // отключено, см view create ?>
<?php $this->renderPartial('_form2', array('model'=>$model)); ?>