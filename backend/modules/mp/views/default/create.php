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
    //array('label'=>'List Mpversions', 'url'=>array('index')),
    array('label'=>Yii::t('rec','Manage Mpversions'), 'url'=>array('admin')),
    );
    ?>

<h1><?php echo Yii::t('rec','Create Mpversions'); ?></h1>
<?php //$this->renderPartial('_addparams', array()); // добавление параметров посредством js выключено, количество математических параметров фиксировано ?>
<?php $this->renderPartial('_form2', array('model'=>$model)); ?>