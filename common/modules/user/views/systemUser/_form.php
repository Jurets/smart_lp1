<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'system-user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activkey'); ?>
		<?php echo $form->textField($model,'activkey',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'activkey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'superuser'); ?>
		<?php echo $form->textField($model,'superuser'); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'roles'); ?>
		<?php echo $form->textField($model,'roles'); ?>
		<?php echo $form->error($model,'roles'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
		<?php echo $form->error($model,'create_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastvisit_at'); ?>
		<?php echo $form->textField($model,'lastvisit_at'); ?>
		<?php echo $form->error($model,'lastvisit_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logincode'); ?>
		<?php echo $form->textField($model,'logincode',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'logincode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tariff_id'); ?>
		<?php echo $form->textField($model,'tariff_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'tariff_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'refer_id'); ?>
		<?php echo $form->textField($model,'refer_id'); ?>
		<?php echo $form->error($model,'refer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inviter_id'); ?>
		<?php echo $form->textField($model,'inviter_id'); ?>
		<?php echo $form->error($model,'inviter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invite_num'); ?>
		<?php echo $form->textField($model,'invite_num'); ?>
		<?php echo $form->error($model,'invite_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'busy_date'); ?>
		<?php echo $form->textField($model,'busy_date'); ?>
		<?php echo $form->error($model,'busy_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'club_date'); ?>
		<?php echo $form->textField($model,'club_date'); ?>
		<?php echo $form->error($model,'club_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'balance'); ?>
		<?php echo $form->textField($model,'balance'); ?>
		<?php echo $form->error($model,'balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gmt_id'); ?>
		<?php echo $form->textField($model,'gmt_id'); ?>
		<?php echo $form->error($model,'gmt_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purse'); ?>
		<?php echo $form->textField($model,'purse',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'purse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'income'); ?>
		<?php echo $form->textField($model,'income'); ?>
		<?php echo $form->error($model,'income'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transfer_fund'); ?>
		<?php echo $form->textField($model,'transfer_fund'); ?>
		<?php echo $form->error($model,'transfer_fund'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activated'); ?>
		<?php echo $form->textField($model,'activated'); ?>
		<?php echo $form->error($model,'activated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sys_lang'); ?>
		<?php echo $form->textField($model,'sys_lang',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'sys_lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_access'); ?>
		<?php echo $form->textField($model,'country_access'); ?>
		<?php echo $form->error($model,'country_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_access'); ?>
		<?php echo $form->textField($model,'city_access'); ?>
		<?php echo $form->error($model,'city_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skype_access'); ?>
		<?php echo $form->textField($model,'skype_access'); ?>
		<?php echo $form->error($model,'skype_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_access'); ?>
		<?php echo $form->textField($model,'email_access'); ?>
		<?php echo $form->error($model,'email_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_email'); ?>
		<?php echo $form->textField($model,'new_email',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'new_email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->