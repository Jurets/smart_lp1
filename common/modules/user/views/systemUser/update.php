<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */

$this->breadcrumbs=array(
	BaseModule::t('rec', 'System Users')=>array('index'),
	" ".$model->id=>array('view','id'=>$model->id),
	BaseModule::t('rec', 'Update User'),
);

$this->menu=array(
	array('label'=>BaseModule::t('rec','List User'), 'url'=>array('index')),
	array('label'=>BaseModule::t('rec', 'Create User'), 'url'=>array('create')),
	array('label'=>BaseModule::t('rec', 'View User'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>BaseModule::t('rec', 'Manage Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec','Update System User') ?> <?php echo $model->id; ?></h1>
<div style="color:red;">
    <?php 
        $buff_trans = BaseModule::t('rec','Empty password field means the old password.fill it only if you want to change old password');
        echo str_replace('.', '<br>', $buff_trans);
    ?>
</div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>