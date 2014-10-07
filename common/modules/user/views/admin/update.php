<?php
$this->breadcrumbs=array(
  BaseModule::t('rec', 'Unified database participants', array(), 'participant') => array('admin'),
    ucfirst(BaseModule::t('rec', 'user')).': '.$model->username=>array('view','id'=>$model->id),
	BaseModule::t('common', 'Update'),
);
$this->menu=array(
    array('label'=>BaseModule::t('rec','Create User'), 'url'=>array('create')),
    array('label'=>BaseModule::t('rec','View User'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>BaseModule::t('rec','Manage Users'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>BaseModule::t('rec','List User'), 'url'=>array('/user')),
);
?>

<h1><?php echo  BaseModule::t('rec','Update User')." ".$model->id; ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model));
?>