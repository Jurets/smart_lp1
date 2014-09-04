<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
    BaseModule::t('rec','FAQ') => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List FAQ'), 'url' => array('index')),
    array('label' => BaseModule::t('common', 'Create FAQ'), 'url' => array('create')),
    array('label' => BaseModule::t('common', 'Update FAQ'), 'url' => array('update', 'id' => $model->id)),
    array('label' => BaseModule::t('common', 'Delete FAQ'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => BaseModule::t('common', 'Manage FAQ'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('common', 'View FAQ') ?> #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'question',
        'answer',
        'created',
        //'id_user',
        'category',
    ),
));
?>
