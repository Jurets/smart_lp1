<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    Yii::t('common', 'Countries') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    Yii::t('common', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Countries'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create Countries'), 'url' => array('create')),
    array('label' => Yii::t('common', 'View Countries'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Manage Countries'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'Update Countries') ?><?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>