<?php
/* @var $this FaqController */
/* @var $model Faq */
$current_id = $model->id;
$this->breadcrumbs = array(
    BaseModule::t('rec','FAQ') => array('index'),
    ' ' . $model->id => array('view', 'id' => $model->id),
    BaseModule::t('rec', 'Update'),
);

$this->menu = array(
    //array('label' => BaseModule::t('common', 'List Faq'), 'url' => array('index')),
    array('label' => BaseModule::t('rec', 'Create').' '.BaseModule::t('rec', 'FAQ'), 'url' => array('create')),
    //array('label' => BaseModule::t('common', 'View Faq'), 'url' => array('view', 'id' => $model->id)),
    array('label' => BaseModule::t('rec', 'Manage').' '.BaseModule::t('rec', 'FAQ'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('common', 'Update').' '.BaseModule::t('rec', 'FAQ').' '?><?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>