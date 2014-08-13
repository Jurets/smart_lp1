<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	'System Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SystemUser', 'url'=>array('index')),
	array('label'=>'Create SystemUser', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#system-user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage System Users</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'system-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'password',
		'email',
		'activkey',
		'superuser',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
