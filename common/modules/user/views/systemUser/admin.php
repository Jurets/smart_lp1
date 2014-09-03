<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','System Users')=>array('index'),
	BaseModule::t('rec','Manage'),
);
$this->menu=array(array('label'=>BaseModule::t('rec','Create System User'), 'url'=>array('create')));
?>

<h1><?php echo BaseModule::t('rec','Manage System Users')?></h1>

<?php  ?>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'system-user-grid',
	'dataProvider'=>$model->systemUsrCriteria(),
	//'filter'=>$model,
	'columns'=>array(
                'first_name',
		'last_name',
                'username',
                array('name'=>'roles', 'value'=>'$data->getRole()'),
                array('name'=>'status', 'value'=>'$data->getStatus()'),
            
		array(
		 'class'=>'CButtonColumn',
		),
	),
)); ?>
