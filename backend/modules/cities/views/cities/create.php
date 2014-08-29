<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    Yii::t('rec', 'Cities') => array('index'),
    Yii::t('rec', 'Create'),
);

$this->menu = array(
    //array('label' => Yii::t('common', 'List Cities'), 'url' => array('index')),
    array('label' => Yii::t('rec', 'Manage Cities'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('rec', 'Create Cities') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>