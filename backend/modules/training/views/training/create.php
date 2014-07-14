<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    Yii::t('common', 'Training') => array('index'),
    Yii::t('common', 'Create'),
);

$this->menu = array(
//	array('label'=>'List Training', 'url'=>array('index')),
    array('label' => Yii::t('common', 'Manage Training'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('common', 'Create Training') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>