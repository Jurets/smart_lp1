<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
    BaseModule::t('rec','FAQ') => array('index'),
    BaseModule::t('rec', 'Create'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', BaseModule::t('rec', 'List FAQ')), 'url' => array('index')),
    //array('label' => BaseModule::t('rec', BaseModule::t('rec', 'Manage FAQ')), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Create FAQ') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>