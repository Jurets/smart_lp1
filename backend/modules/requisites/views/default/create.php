<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Requisites') => array('index'),
    BaseModule::t('common', 'Create'),
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Requisites'), 'url' => array('admin')),
    array('label' => BaseModule::t('common', 'Manage Requisites'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('common', 'Create Requisites') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>