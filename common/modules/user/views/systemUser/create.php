<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	Yii::t('rec','System Users')=>array('index'),
	Yii::t('rec','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('rec','Manage System Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('rec','Create System User')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>