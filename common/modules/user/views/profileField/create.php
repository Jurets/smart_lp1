<?php
$this->breadcrumbs=array(
	Yii::t('rec','Profile Fields')=>array('admin'),
	Yii::t('rec','Create'),
);
$this->menu=array(
    array('label'=>Yii::t('rec','Manage Profile Field'), 'url'=>array('admin')),
    array('label'=>Yii::t('rec','Manage Users'), 'url'=>array('/user/admin')),
);
?>
<h1><?php echo Yii::t('rec','Create Profile Field'); ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>