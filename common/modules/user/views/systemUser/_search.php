<?php
/* @var $this SystemUserController */
/* @var $model SystemUser */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activkey'); ?>
		<?php echo $form->textField($model,'activkey',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'superuser'); ?>
		<?php echo $form->textField($model,'superuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'roles'); ?>
		<?php echo $form->textField($model,'roles'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastvisit_at'); ?>
		<?php echo $form->textField($model,'lastvisit_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'logincode'); ?>
		<?php echo $form->textField($model,'logincode',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tariff_id'); ?>
		<?php echo $form->textField($model,'tariff_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'refer_id'); ?>
		<?php echo $form->textField($model,'refer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inviter_id'); ?>
		<?php echo $form->textField($model,'inviter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invite_num'); ?>
		<?php echo $form->textField($model,'invite_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'busy_date'); ?>
		<?php echo $form->textField($model,'busy_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'club_date'); ?>
		<?php echo $form->textField($model,'club_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'balance'); ?>
		<?php echo $form->textField($model,'balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gmt_id'); ?>
		<?php echo $form->textField($model,'gmt_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purse'); ?>
		<?php echo $form->textField($model,'purse',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'income'); ?>
		<?php echo $form->textField($model,'income'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transfer_fund'); ?>
		<?php echo $form->textField($model,'transfer_fund'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activated'); ?>
		<?php echo $form->textField($model,'activated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sys_lang'); ?>
		<?php echo $form->textField($model,'sys_lang',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_access'); ?>
		<?php echo $form->textField($model,'country_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_access'); ?>
		<?php echo $form->textField($model,'city_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'skype_access'); ?>
		<?php echo $form->textField($model,'skype_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_access'); ?>
		<?php echo $form->textField($model,'email_access'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'new_email'); ?>
		<?php echo $form->textField($model,'new_email',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->