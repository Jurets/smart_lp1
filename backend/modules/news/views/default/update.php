<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'News' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => Yii::t('common', 'List News'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create News'), 'url' => array('create')),
    array('label' => Yii::t('common', 'View News'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Manage News'), 'url' => array('admin')),
);
?>

<h1>Update News <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>