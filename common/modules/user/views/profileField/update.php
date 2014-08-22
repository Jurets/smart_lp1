<?php
$this->breadcrumbs=array(
	Yii::t('rec','Profile Fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('rec','Update'),
);
$this->menu=array(
    array('label'=>Yii::t('rec','Create Profile Field'), 'url'=>array('create')),
    array('label'=>Yii::t('rec','View Profile Field'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>Yii::t('rec','Manage Profile Field'), 'url'=>array('admin')),
    array('label'=>Yii::t('rec','Manage Users'), 'url'=>array('/user/admin')),
);
?>

<h1><?php echo Yii::t('rec','Update Profile Field ').$model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>