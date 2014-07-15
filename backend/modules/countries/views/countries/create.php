<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    Yii::t('common', 'Countries') => array('index'),
    Yii::t('common', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Countries'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Manage Countries'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'Create Countries') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>