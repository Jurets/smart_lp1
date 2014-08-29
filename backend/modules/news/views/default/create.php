<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    Yii::t('rec', 'News') => array('index'),
    Yii::t('rec', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('rec', 'List News'), 'url' => array('index')),
    array('label' => Yii::t('rec', 'Manage News'), 'url' => array('admin')),
);
?>
</div>
<h1><?php echo Yii::t('rec','Create News') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>