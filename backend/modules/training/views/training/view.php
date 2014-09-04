<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Training') => array('index'),
    $model->title,
);

$this->menu = array(
//	array('label'=>'List Training', 'url'=>array('index')),
    array('label' => BaseModule::t('rec', 'Create Training'), 'url' => array('create')),
    array('label' => BaseModule::t('rec', 'Update Training'), 'url' => array('update', 'id' => $model->id)),
    array('label' => BaseModule::t('rec', 'Delete Training'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => BaseModule::t('rec', 'Are you sure you want to delete this item?'))),
    array('label' => BaseModule::t('rec', 'Manage Training'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('common','View Training') ?>#<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        'description',
        array(
            'name' => 'image',
            'type' => 'html',
            'value' => TbHtml::image($model->image),
        ),
        'videolink',
        'date',
        'number',
    ),
));
?>
