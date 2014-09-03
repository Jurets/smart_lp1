<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Profile Fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	BaseModule::t('rec','Update'),
);
$this->menu=array(
    array('label'=>BaseModule::t('rec','Create Profile Field'), 'url'=>array('create')),
    array('label'=>BaseModule::t('rec','View Profile Field'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>BaseModule::t('rec','Manage Profile Field'), 'url'=>array('admin')),
    array('label'=>BaseModule::t('rec','Manage Users'), 'url'=>array('/user/admin')),
);
?>

<h1><?php echo BaseModule::t('rec','Update Profile Field ').$model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>