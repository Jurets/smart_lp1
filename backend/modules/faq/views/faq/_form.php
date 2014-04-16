<?php
/* @var $this FaqController */
/* @var $model Faq */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'faq-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'question'); ?>
        <?php echo $form->textArea($model, 'question', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'question'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'answer'); ?>
        <?php
        $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
            'model' => $model,
            'attribute' => 'answer',
            'pluginOptions' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => true,
            ),));
        ?>
        <?php echo $form->error($model, 'answer'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'created'); ?>
        <?php
        $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
            'model' => $model,
            'name' => 'created',
            'attribute' => 'created',
            'format' => 'dd.MM.yyyy hh:mm:ss',
                ))
        ?>
        <?php echo $form->error($model, 'created'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'id_user'); ?>
        <?php echo $form->textField($model, 'id_user'); ?>
        <?php echo $form->error($model, 'id_user'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'category'); ?>
        <?php echo $form->dropDownList($model, 'category', array('finance' => 'финансы', 'offer' => 'предложения', 'site' => 'работа сайта')); ?>
        <?php echo $form->error($model, 'category'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->