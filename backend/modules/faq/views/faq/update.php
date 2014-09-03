<?php
/* @var $this FaqController */
/* @var $model Faq */
$current_id = $model->id;
$this->breadcrumbs = array(
    'FAQ' => array('index'),
    ' ' . $model->id => array('view', 'id' => $model->id),
    BaseModule::t('common', 'Update'),
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Faq'), 'url' => array('index')),
    array('label' => BaseModule::t('common', 'Create Faq'), 'url' => array('create')),
    array('label' => BaseModule::t('common', 'View Faq'), 'url' => array('view', 'id' => $model->id)),
    array('label' => BaseModule::t('common', 'Manage Faq'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('common', 'Update FAQ') ?><?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>