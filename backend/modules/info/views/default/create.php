<?php
/* @var $this DefaultController */
/* @var $model Information */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Information') => array('index'),
    BaseModule::t('rec', 'Create'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'List Information'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Create') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>