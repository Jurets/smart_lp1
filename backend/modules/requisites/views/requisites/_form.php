<?php
/* @var $this RequisitesController */
/* @var $model Requisites */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'requisites-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo Yii::t('common', 'Fields with {asteriks} are required', array('{asteriks}' => '<span class="required">*</span>')); ?>.</p>

    <?php echo $form->errorSummary($model); ?>

    <!--	<div class="row">
    <?php //echo $form->labelEx($model,'id'); ?>
<?php //echo $form->textField($model,'id',array('size'=>50,'maxlength'=>50));  ?>
<?php //echo $form->error($model,'id');  ?>
            </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'details'); ?>
<?php echo $form->textArea($model, 'details', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'details'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'agreement'); ?>
<?php echo $form->textArea($model, 'agreement', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'agreement'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'marketing'); ?>
<?php echo $form->textArea($model, 'marketing', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'marketing'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'pw_supervisor'); ?>
<?php echo $form->textField($model, 'pw_supervisor', array('size' => 20, 'maxlength' => 20)); ?>
<?php echo $form->error($model, 'pw_supervisor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'pw_admin'); ?>
<?php echo $form->textField($model, 'pw_admin', array('size' => 20, 'maxlength' => 20)); ?>
<?php echo $form->error($model, 'pw_admin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'pw_moderator'); ?>
<?php echo $form->textField($model, 'pw_moderator', array('size' => 20, 'maxlength' => 20)); ?>
<?php echo $form->error($model, 'pw_moderator'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'purse_activation'); ?>
<?php echo $form->textField($model, 'purse_activation', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'purse_activation'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'purse_club'); ?>
<?php echo $form->textField($model, 'purse_club', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'purse_club'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'bpm_login'); ?>
        <?php echo $form->textField($model, 'bpm_login', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'bpm_login'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'bpm_password'); ?>
        <?php echo $form->textField($model, 'bpm_password', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'bpm_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'purse_investor'); ?>
<?php echo $form->textField($model, 'purse_investor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'purse_investor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'purse_fdl'); ?>
<?php echo $form->textField($model, 'purse_fdl', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'purse_fdl'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->