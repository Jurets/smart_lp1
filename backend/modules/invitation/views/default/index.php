<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>
<h1><?php echo Yii::t('common', 'Invitation'); ?></h1>

<?php $this->renderPartial('_copyer', array()); ?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>