<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Information') => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Information'), 'url' => array('index')),
    array('label' => BaseModule::t('common', 'Create Information'), 'url' => array('create')),
    array('label' => BaseModule::t('common', 'Update Information'), 'url' => array('update', 'id' => $model->id)),
    array('label' => BaseModule::t('common', 'Delete Information'), 'url' => '#', 'linkOptions' => array(
        'submit' => array('delete', 'id' => $model->id), 'confirm' => BaseModule::t('rec', 'Are you sure to delete this item?')),
    ),
);
?>

<h1><?php echo BaseModule::t('common', 'View Information') ?> #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        array(
            'name' => 'text',
            'type' => 'raw',
        ),
    ),
));
?>
