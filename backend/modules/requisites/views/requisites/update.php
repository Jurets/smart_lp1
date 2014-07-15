<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    Yii::t('common', 'Requisites') => array('index'),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('common', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Requisites'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create Requisites'), 'url' => array('create')),
    array('label' => Yii::t('common', 'View Requisites'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Manage Requisites'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'Update Requisites') ?><?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>