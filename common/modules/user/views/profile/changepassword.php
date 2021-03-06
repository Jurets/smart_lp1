<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change password");
$this->breadcrumbs=array(
	BaseModule::t('rec',"Profile") => array('/user/profile'),
	BaseModule::t('rec',"Change password"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>BaseModule::t('rec','Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>BaseModule::t('rec','List User'), 'url'=>array('/user')),
    array('label'=>BaseModule::t('rec','Profile'), 'url'=>array('/user/profile')),
    array('label'=>BaseModule::t('rec','Edit'), 'url'=>array('edit')),
    array('label'=>BaseModule::t('rec','Logout'), 'url'=>array('/user/logout')),
);
?>

<h1><?php echo UserModule::t("Change password"); ?></h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'oldPassword'); ?>
	<?php echo $form->passwordField($model,'oldPassword'); ?>
	<?php echo $form->error($model,'oldPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo BaseModule::t('rec',"Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(BaseModule::t('rec',"Save")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->