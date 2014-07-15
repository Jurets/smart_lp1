<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    Yii::t('common', 'Countries') => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Countries'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create Countries'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Update Countries'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Delete Countries'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('common', 'Manage Countries'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'View Countries') ?>#<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'code',
        'code_num',
        'phone_code',
        'gmt_id',
    ),
));
?>
