<?php
/* @var $this MpversionsController */
/* @var $model Mpversions */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'mpversions-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'description',array('span'=>5,'maxlength'=>255)); ?>

            <?php echo $form->textFieldControlGroup($model,'creationdate',array('span'=>5, 'disabled'=>'true')); ?>

            <?php echo $form->checkBoxControlGroup($model,'activity',array('span'=>5)); ?>
    
            <?php echo $form->hiddenField($model, 'id'); ?>
    
            <?php if(is_array($model->mathparams) && count($model->mathparams) > 0) { ?>
            <?php foreach ($model->mathparams as $key=>$mathparam){ ?>
            <div class="copy">
                <span class="mr"><?php echo BaseModule::t('rec', 'name') ; ?></span>
            <?php echo $form->textField($mathparam, 'name', array('name'=>'Mathparams[name][]', 'id'=>false)); ?>
            <?php echo $form->error($mathparam, 'name'); ?>
            <span class="mr"><?php echo BaseModule::t('rec', 'value') ; ?></span>
            <?php echo $form->textField($mathparam, 'value', array('name'=>'Mathparams[value][]', 'id'=>false)); ?>
            <?php echo $form->error($mathparam, 'value'); ?>
            <?php echo $form->hiddenField($mathparam, 'id', array('name'=>'Mathparams[id][]', 'id'=>false)); ?>
            <span class="icon-trash" title="<?php echo BaseModule::t('rec', 'Delete') ; ?>" onclick="$(this).parent().remove(); return false;"> </span>
            <div></div>
            </div>
        <?php } ?>
            <?php }else{ ?>
            <div class="copy">
                <span class="mr"><?php echo BaseModule::t('rec', 'name'); ?></span>
                <?php echo CHtml::textField('Mathparams[name][]','',array('maxlength'=>255)); ?>
                <span class="mr"><?php echo BaseModule::t('rec', 'value'); ?></span>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?>
                <span class="icon-trash" title="<?php echo BaseModule::t('rec', 'Delete') ; ?>" onclick="$(this).parent().remove(); return false;"> </span>
            </div>
            <?php } ?>
    <?php echo TbHtml::button(BaseModule::t('rec', 'Add'), array(
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                    'rel'=>'.copy',
                    'id'=>'addMathParams',
                )); ?>
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? BaseModule::t('rec', 'Create') : BaseModule::t('rec', 'Save'),array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
        </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->