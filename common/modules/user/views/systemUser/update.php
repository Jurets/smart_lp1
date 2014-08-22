<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	Yii::t('rec', 'System Users')=>array('index'),
	" ".$model->id=>array('view','id'=>$model->id),
	Yii::t('rec', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('rec','List SystemUser'), 'url'=>array('index')),
	array('label'=>Yii::t('rec', 'Create SystemUser'), 'url'=>array('create')),
	array('label'=>Yii::t('rec', 'View SystemUser'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('rec', 'Manage SystemUser'), 'url'=>array('admin')),
);
?>

<h1><?php echo UserModule::t('Update System User') ?> <?php echo $model->id; ?></h1>
<div style="color:red;">
    <?php echo Yii::t('rec','<br>Empty password field means the old password<br>fill it only if you want to change old password.<br><br>') ?>
</div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>