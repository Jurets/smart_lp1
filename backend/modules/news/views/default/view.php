<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    Yii::t('rec', 'News') => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => Yii::t('rec', 'List News'), 'url' => array('index')),
    array('label' => Yii::t('rec', 'Create News'), 'url' => array('create')),
    array('label' => Yii::t('rec', 'Update News'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('rec', 'Delete News'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('rec', 'Manage News'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common','View News') ?> #<?php echo $model->id; ?></h1>
<img src="<?php echo '/admin'. $model->getUploadImage(); //echo Yii::app()->baseUrl . '/uploads/' . 'resized-' . $model->image  ?>" />

<?php
$this->widget('yiiwheels.widgets.detail.WhDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'author',
        'created',
        'activated',
        'title',
        'announcement',
        'content',
        'image',
        'activity',
    ),
));
?>
