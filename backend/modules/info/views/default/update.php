<?php
/* @var $this DefaultController */
/* @var $model Information */

$this->breadcrumbs = array(
    //BaseModule::t('common', 'Requisites') => array('index'),
    //$model->id => array('view', 'id' => $model->id),
    BaseModule::t('rec', 'Information'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'List Information'), 'url' => array('index')),
    array('label' => BaseModule::t('rec', 'Create Information'), 'url' => array('create')),
    array('label' => BaseModule::t('rec', 'View Information'), 'url' => array('view', 'id' => $model->id)),
    array('label' => BaseModule::t('rec', 'Delete Information'), 'url' => '#', 'linkOptions' => array(
        'submit' => array('delete', 'id' => $model->id), 'confirm' => BaseModule::t('rec', 'Are you sure to delete this item?')),
    ),
);
?>

<h1><?php echo BaseModule::t('rec', 'Update Information') ?> #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model));?>