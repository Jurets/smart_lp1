<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Information') => array('index'),
    BaseModule::t('common', 'Create'),
);

$this->menu = array(
    //array('label' => BaseModule::t('common', 'Information'), 'url' => array('admin')),
    //array('label' => BaseModule::t('common', 'Manage Requisites'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('common', 'Create') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>