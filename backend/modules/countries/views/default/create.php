<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Countries') => array('index'),
    BaseModule::t('rec', 'Create'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'Manage Countries'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Create Countries') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>