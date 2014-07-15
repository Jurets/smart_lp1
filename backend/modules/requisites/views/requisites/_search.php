<?php
/* @var $this RequisitesController */
/* @var $model Requisites */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'details'); ?>
		<?php echo $form->textArea($model,'details',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agreement'); ?>
		<?php echo $form->textArea($model,'agreement',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marketing'); ?>
		<?php echo $form->textArea($model,'marketing',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pw_supervisor'); ?>
		<?php echo $form->textField($model,'pw_supervisor',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pw_admin'); ?>
		<?php echo $form->textField($model,'pw_admin',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pw_moderator'); ?>
		<?php echo $form->textField($model,'pw_moderator',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purse_activation'); ?>
		<?php echo $form->textField($model,'purse_activation',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purse_club'); ?>
		<?php echo $form->textField($model,'purse_club',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purse_investor'); ?>
		<?php echo $form->textField($model,'purse_investor',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purse_fdl'); ?>
		<?php echo $form->textField($model,'purse_fdl',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_faq'); ?>
		<?php echo $form->textArea($model,'email_faq',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->