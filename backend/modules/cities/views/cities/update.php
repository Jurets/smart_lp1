<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    Yii::t('common', 'Cities') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    Yii::t('common', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('common', Yii::t('common', 'List Cities')), 'url' => array('index')),
    array('label' => Yii::t('common', Yii::t('common', 'Create Cities')), 'url' => array('create')),
    array('label' => Yii::t('common', Yii::t('common', 'View Cities')), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('common', Yii::t('common', 'Manage Cities')), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'Update Cities') ?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>