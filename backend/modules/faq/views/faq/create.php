<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
    'FAQ' => array('index'),
    Yii::t('common', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('common', Yii::t('common', 'List FAQ')), 'url' => array('index')),
    array('label' => Yii::t('common', Yii::t('common', 'Manage FAQ')), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'Create FAQ') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>