<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
    Yii::t('rec','FAQ') => array('index'),
    Yii::t('rec', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('rec', Yii::t('rec', 'List FAQ')), 'url' => array('index')),
    array('label' => Yii::t('rec', Yii::t('rec', 'Manage FAQ')), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('rec', 'Create FAQ') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>