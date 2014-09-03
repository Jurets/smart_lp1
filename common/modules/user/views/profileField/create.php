<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Profile Fields')=>array('admin'),
	BaseModule::t('rec','Create'),
);
$this->menu=array(
    array('label'=>BaseModule::t('rec','Manage Profile Field'), 'url'=>array('admin')),
    array('label'=>BaseModule::t('rec','Manage Users'), 'url'=>array('/user/admin')),
);
?>
<h1><?php echo BaseModule::t('rec','Create Profile Field'); ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>