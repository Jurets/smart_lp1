<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	Yii::t('rec','Index Management')=>$this->module->id,
);
?>
<h1><?php echo Yii::t('rec','Index Management'); ?></h1>

<?php $this->renderPartial('_copyer', array()); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>