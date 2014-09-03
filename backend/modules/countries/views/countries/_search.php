<?php
/* @var $this CountriesController */
/* @var $model Countries */
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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'code_num'); ?>
		<?php echo $form->textField($model,'code_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone_code'); ?>
		<?php echo $form->textField($model,'phone_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gmt_id'); ?>
		<?php echo $form->textField($model,'gmt_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(BaseModule::t('rec', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->