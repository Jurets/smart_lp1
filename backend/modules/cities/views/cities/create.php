<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    Yii::t('common', 'Cities') => array('index'),
    Yii::t('common', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Cities'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Manage Cities'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'Create Cities') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>