<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Invitations'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Invitation', 'url'=>array('index')),
	array('label'=>Yii::t('common', 'Create'), 'url'=>array('create')),
	array('label'=>Yii::t('common', 'Update'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common', 'Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('common', 'Manage'), 'url'=>array('index')),
);
?>

<h1>View Invitation #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'video_link',
		'file',
		'file_link',
		'created',
	),
)); ?>
