<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    Yii::t('common', 'Cities') => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Cities'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create Cities'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Update Cities'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Delete Cities'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('common', 'Manage Cities'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'View Cities') ?> #<?php echo $model->id; ?></h1>

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
