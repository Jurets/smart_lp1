<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo FaqmModule::t('FAQ Management'); ?></h1>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>