<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'indexmanager-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<?php echo $form->errorSummary($modelEmail); ?>
    
  <?php echo $form->textFieldControlGroup($modelEmail,'financialMail',array('span'=>5,'maxlength'=>255)); ?>
  <?php echo $form->textFieldControlGroup($modelEmail, 'offerMail', array('span'=>5, 'maxlength'=>255)); ?>
  <?php echo $form->textFieldControlGroup($modelEmail, 'performanceMail', array('span'=>5, 'maxlength'=>255)); ?>
    

    <div class="form">
        <?php echo TbHtml::submitButton( BaseModule::t('rec', 'Create'), array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
    </div>
<?php $this->endWidget(); ?>
</div>