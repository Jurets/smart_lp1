<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    Yii::t('common', 'Requisites') => array('index'),
    Yii::t('common', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Requisites'), 'url' => array('admin')),
    array('label' => Yii::t('common', 'Manage Requisites'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('common', 'Create Requisites') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>