<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Requisites') => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Requisites'), 'url' => array('index')),
   // array('label' => BaseModule::t('common', 'Create Requisites'), 'url' => array('create')),
    array('label' => BaseModule::t('common', 'Update Requisites'), 'url' => array('update', 'id' => $model->id)),
    array('label' => BaseModule::t('common', 'Delete Requisites'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => BaseModule::t('common', 'Manage Requisites'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('common', 'View Requisites') ?>#<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'details',
        'agreement',
        'marketing',
        'pw_supervisor',
        'pw_admin',
        'pw_moderator',
        'purse_activation',
        'purse_club',
        'purse_investor',
        'purse_fdl',
    ),
));
?>
