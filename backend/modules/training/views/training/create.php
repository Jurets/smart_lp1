<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    Yii::t('rec', 'Training') => array('index'),
    Yii::t('rec', 'Create'),
);

$this->menu = array(
//	array('label'=>'List Training', 'url'=>array('index')),
    array('label' => Yii::t('rec', 'Manage Trainings'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('rec', 'Create Training') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>