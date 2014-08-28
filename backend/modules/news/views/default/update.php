<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    Yii::t('rec','News') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    Yii::t('rec','Update News'),
);

$this->menu = array(
    array('label' => Yii::t('rec', 'List News'), 'url' => array('index')),
    array('label' => Yii::t('rec', 'Create News'), 'url' => array('create')),
    array('label' => Yii::t('rec', 'View News'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('rec', 'Manage News'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('rec','Update News')?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>