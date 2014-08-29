<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    Yii::t('rec', 'Countries') => array('index'),
    Yii::t('rec', 'Create'),
);

$this->menu = array(
    //array('label' => Yii::t('common', 'List Countries'), 'url' => array('index')),
    array('label' => Yii::t('rec', 'Manage Countries'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('rec', 'Create Countries') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>