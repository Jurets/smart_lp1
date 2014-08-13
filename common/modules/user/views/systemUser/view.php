<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	'System Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SystemUser', 'url'=>array('index')),
	array('label'=>'Create SystemUser', 'url'=>array('create')),
	array('label'=>'Update SystemUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SystemUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SystemUser', 'url'=>array('admin')),
);
?>

<h1>View SystemUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
		'activkey',
		'superuser',
		'roles',
		'status',
		'create_at',
		'lastvisit_at',
		'logincode',
		'tariff_id',
		'refer_id',
		'inviter_id',
		'invite_num',
		'busy_date',
		'club_date',
		'balance',
		'first_name',
		'last_name',
		'dob',
		'city_id',
		'gmt_id',
		'phone',
		'skype',
		'photo',
		'purse',
		'income',
		'transfer_fund',
		'active',
		'activated',
		'sys_lang',
		'country_access',
		'city_access',
		'skype_access',
		'email_access',
		'new_email',
	),
)); ?>
