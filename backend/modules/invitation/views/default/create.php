<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Invitations'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Invitation', 'url'=>array('index')),
	array('label'=>Yii::t('common', 'Manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo InvitationModule::t('Create Invitation'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>