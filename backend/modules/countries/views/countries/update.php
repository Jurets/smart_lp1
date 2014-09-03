<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Countries') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    BaseModule::t('common', 'Update'),
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Countries'), 'url' => array('index')),
    array('label' => BaseModule::t('common', 'Create Countries'), 'url' => array('create')),
    array('label' => BaseModule::t('common', 'View Countries'), 'url' => array('view', 'id' => $model->id)),
    array('label' => BaseModule::t('common', 'Manage Countries'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('common', 'Update Countries') ?><?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>