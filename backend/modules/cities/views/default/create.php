<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Cities') => array('index'),
    BaseModule::t('rec', 'Create'),
);

$this->menu = array(
    //array('label' => BaseModule::t('common', 'List Cities'), 'url' => array('index')),
    array('label' => BaseModule::t('rec', 'Manage Cities'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Create Cities') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>