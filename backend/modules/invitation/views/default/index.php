<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    Yii::t('rec', 'Invitation'),
);
?>
<h1><?php echo Yii::t('rec', 'Invitation'); ?></h1>

<?php $this->renderPartial('_copyer', array()); ?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>