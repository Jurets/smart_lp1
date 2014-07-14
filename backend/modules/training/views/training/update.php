<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    Yii::t('common', 'Training') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    Yii::t('common', 'Update'),
);

$this->menu = array(
//	array('label'=>'List Training', 'url'=>array('index')),
    array('label' => Yii::t('common', 'Create Training'), 'url' => array('create')),
    array('label' => Yii::t('common', 'View Training'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Manage Training'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('common', 'Update Training') ?>  <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>