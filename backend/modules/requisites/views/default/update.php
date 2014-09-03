<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    //BaseModule::t('common', 'Requisites') => array('index'),
    //$model->id => array('view', 'id' => $model->id),
    BaseModule::t('common', 'Requisites'),
);

$this->menu = array(
    //array('label' => BaseModule::t('common', 'List Requisites'), 'url' => array('index')),
   // array('label' => BaseModule::t('common', 'Create Requisites'), 'url' => array('create')),
    //array('label' => BaseModule::t('common', 'View Requisites'), 'url' => array('view', 'id' => $model->id)),
    //array('label' => BaseModule::t('common', 'Manage Requisites'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Update Requisites') ?> <?php //echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>