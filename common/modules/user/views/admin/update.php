<?php
$this->breadcrumbs=array(
  Yii::t('rec', 'Unified database participants', array(), 'participant') => array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(Yii::t('common', 'Update')),
);
$this->menu=array(
    array('label'=>Yii::t('rec','Create User'), 'url'=>array('create')),
    array('label'=>Yii::t('rec','View User'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>Yii::t('rec','Manage Users'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>Yii::t('rec','List User'), 'url'=>array('/user')),
);
?>

<h1><?php echo  Yii::t('rec','Update User')." ".$model->id; ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model));
?>