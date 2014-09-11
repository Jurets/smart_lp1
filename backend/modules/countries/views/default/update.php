<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Countries') => array('index'),
    BaseModule::t('rec', 'Update'),
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Countries'), 'url' => array('index')),
    array('label' => BaseModule::t('common', 'Create Countries'), 'url' => array('create')),
);
?>

<h1><?php echo BaseModule::t('common', 'Update Countries') ?><?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>