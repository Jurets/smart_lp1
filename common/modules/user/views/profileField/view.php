<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Profile Fields')=>array('admin'),
	BaseModule::t('rec',$model->title),
);
$this->menu=array(
    array('label'=>BaseModule::t('rec','Create Profile Field'), 'url'=>array('create')),
    array('label'=>BaseModule::t('rec','Update Profile Field'), 'url'=>array('update','id'=>$model->id)),
    array('label'=>BaseModule::t('rec','Delete Profile Field'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
    array('label'=>BaseModule::t('rec','Manage Profile Field'), 'url'=>array('admin')),
    array('label'=>BaseModule::t('rec','Manage Users'), 'url'=>array('/user/admin')),
);
?>
<h1><?php echo BaseModule::t('rec','View Profile Field #').$model->varname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'varname',
		'title',
		'field_type',
		'field_size',
		'field_size_min',
		'required',
		'match',
		'range',
		'error_message',
		'other_validator',
		'widget',
		'widgetparams',
		'default',
		'position',
		'visible',
	),
)); ?>
