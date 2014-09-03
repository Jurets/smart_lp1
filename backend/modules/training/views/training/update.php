<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Training') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    BaseModule::t('rec', 'Update'),
);

$this->menu = array(
//	array('label'=>'List Training', 'url'=>array('index')),
    array('label' => BaseModule::t('rec', 'Create Training'), 'url' => array('create')),
   // array('label' => BaseModule::t('rec', 'View Training'), 'url' => array('view', 'id' => $model->id)),
    array('label' => BaseModule::t('rec', 'Manage Trainings'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Update Training') ?>  <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>