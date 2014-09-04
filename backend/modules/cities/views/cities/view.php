<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Cities') => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Cities'), 'url' => array('index')),
    array('label' => BaseModule::t('common', 'Create Cities'), 'url' => array('create')),
    array('label' => BaseModule::t('common', 'Update Cities'), 'url' => array('update', 'id' => $model->id)),
    array('label' => BaseModule::t('common', 'Delete Cities'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => BaseModule::t('common', 'Manage Cities'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('common', 'View Cities') ?> #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'country_id',
        'name',
    ),
));
?>
