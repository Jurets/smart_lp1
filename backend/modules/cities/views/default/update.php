<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Cities') => array('index'),
    //$model->name => array('view', 'id' => $model->id),
    BaseModule::t('common', 'Update'),
);

$this->menu = array(
    //array('label' => BaseModule::t('common', BaseModule::t('common', 'List Cities')), 'url' => array('index')),
    array('label' => BaseModule::t('common', BaseModule::t('common', 'Create Cities')), 'url' => array('create')),
    //array('label' => BaseModule::t('common', BaseModule::t('common', 'View Cities')), 'url' => array('view', 'id' => $model->id)),
    array('label' => BaseModule::t('common', BaseModule::t('common', 'Manage Cities')), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('common', 'Update City') ?> <?php //echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>