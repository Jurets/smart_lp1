<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    Yii::t('rec', 'Training') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    Yii::t('rec', 'Update'),
);

$this->menu = array(
//	array('label'=>'List Training', 'url'=>array('index')),
    array('label' => Yii::t('rec', 'Create Training'), 'url' => array('create')),
   // array('label' => Yii::t('rec', 'View Training'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('rec', 'Manage Trainings'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('rec', 'Update Training') ?>  <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>