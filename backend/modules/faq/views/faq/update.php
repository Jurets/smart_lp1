`<?php
/* @var $this FaqController */
/* @var $model Faq */
$current_id = $model->id;
$this->breadcrumbs = array(
    'FAQ' => array('index'),
    ' ' . $model->id => array('view', 'id' => $model->id),
    Yii::t('common', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Faq'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create Faq'), 'url' => array('create')),
    array('label' => Yii::t('common', 'View Faq'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Manage Faq'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'Update FAQ') ?><?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>