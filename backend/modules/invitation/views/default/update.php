<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Invitations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('common', 'Create'), 'url'=>array('create')),
    array('label'=>Yii::t('common', 'View'),   'url'=>array('view', 'id'=>$model->id)),
    array('label'=>Yii::t('common', 'Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>Yii::t('common', 'Manage'), 'url'=>array('index')),
    
);
?>

<h1><?php echo InvitationModule::t('Update Invitation'); ?> #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>