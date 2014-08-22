<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo FaqmModule::t('FAQ Management'); ?></h1>
<?php
if(Yii::app()->user->hasFlash('wrong_form')){
    echo '<div class="alert alert-error">',Yii::app()->user->getFlash('wrong_form'),'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>