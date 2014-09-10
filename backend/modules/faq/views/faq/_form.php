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

    <p class="note"><?php echo htmlspecialchars_decode(BaseModule::t('rec',  htmlspecialchars("You may optionally enter a comparison operator ( <, <=, >, >=, <> or = ) at the beginning of each of your search values to specify how the comparison should be done.")));?>.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        
        <?php echo $form->hiddenField($model, 'lng')?>
        
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
                'lang' => Yii::app()->language,
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
        <?php echo $form->labelEx($model, 'category'); ?>
        <?php echo $form->dropDownList($model, 'category', array('finance' => BaseModule::t('dic', 'Finance'), 'offer' => BaseModule::t('dic', 'Offers'), 'site' => BaseModule::t('dic', 'Site work'))); ?>
        <?php echo $form->error($model, 'category'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? BaseModule::t('dic', 'Create') : BaseModule::t('dic', 'Save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
