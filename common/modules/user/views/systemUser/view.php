<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	" ".UserModule::t('System Users')=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>UserModule::t('Manage System Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo UserModule::t('View System User')?> <?php echo $model->id; ?></h1>
<?php
$attributes = array('id', 'username', 'password', 'first_name', 'last_name','email');
$attributes[] = array('name'=>'status', 'value'=>$status);
$attributes[] = array('name'=>'roles', 'value'=>$role);
?>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
        'attributes'=>$attributes,
)); ?>
