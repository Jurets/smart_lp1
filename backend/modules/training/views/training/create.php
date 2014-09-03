<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Training') => array('index'),
    BaseModule::t('rec', 'Create'),
);

$this->menu = array(
//	array('label'=>'List Training', 'url'=>array('index')),
    array('label' => BaseModule::t('rec', 'Manage Trainings'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Create Training') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>