<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	BaseModule::t('rec','Manage').' '.BaseModule::t('rec','FAQ'),
);
?>
<h1><?php echo BaseModule::t('rec','Manage').' '.BaseModule::t('rec','FAQ'); ?></h1>
<?php
if(Yii::app()->user->hasFlash('wrong_form')){
    echo '<div class="alert alert-error">',Yii::app()->user->getFlash('wrong_form'),'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>