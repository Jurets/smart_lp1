<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    Yii::t('common', 'News') => array('index'),
    Yii::t('common', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List News'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Manage News'), 'url' => array('admin')),
);
?>
</div>
<h1>Create News</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>