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
        <table>
                <?php foreach ($model->mathparams as $key=>$mathparam) { ?>
                    <tr>
                        <div class="copy">
                            <td id="mr">
                                <span class="mr"><?php echo BaseModule::t('rec',  Mathparams::$parameters[$key]) ; ?></span>
                            </td>
                            <td>
                                <?php echo $form->hiddenField($mathparam, 'name', array('name'=>'Mathparams[name][]', 'id'=>false, 'readonly'=>"readonly")); ?>
                                <?php echo $form->error($mathparam, 'name'); ?>
                                <?php echo $form->textField($mathparam, 'value', array('name'=>'Mathparams[value][]', 'id'=>false)); ?>
                                <?php echo $form->error($mathparam, 'value'); ?>
                                <?php echo $form->hiddenField($mathparam, 'id', array('name'=>'Mathparams[id][]', 'id'=>false)); ?>
                            </td>
                            <div></div>
                        </div>
                    </tr>
            <?php } ?>
        </table>
    <?php }else{ ?>
    <table border="0">
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec',  Mathparams::$parameters[0]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','price_activation',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[1]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','price_start',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[2]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','percent_to_A',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[3]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','percent_pot_B1',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[4]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','percent_pot_B2',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[5]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','percent_pot_B3',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[6]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','percent_to_F',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[7]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','cost_B1',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[8]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','cost_B2',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>
            <tr><div class="copy">
                <td id="mr"><span class="mr"><?php echo BaseModule::t('rec', Mathparams::$parameters[9]); ?></span></td>
                <td><?php echo CHtml::hiddenField('Mathparams[name][]','cost_B3',array('maxlength'=>255, 'readonly'=>"readonly")); ?>
                <?php echo CHtml::textField('Mathparams[value][]','',array('maxlength'=>255)); ?>
                <?php echo CHtml::hiddenField('Mathparams[id][]', '', array('id'=>FALSE)); ?></td>
            </div></tr>

            <?php } ?>
    </table>
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? BaseModule::t('rec','Create') : BaseModule::t('rec','Save'),array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
        </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<style>
    #mr {padding-bottom: 10px;}
</style>