<?php
/* @var $this CountriesController */
/* @var $model Countries */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'countries-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

     <p class="note"><?php echo Yii::t('common', 'Fields with {asteriks} are required', array('{asteriks}' => '<span class="required">*</span>')); ?>.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'code'); ?>
<?php echo $form->textField($model, 'code', array('size' => 10, 'maxlength' => 10)); ?>
<?php echo $form->error($model, 'code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'code_num'); ?>
<?php echo $form->textField($model, 'code_num'); ?>
<?php echo $form->error($model, 'code_num'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone_code'); ?>
<?php echo $form->textField($model, 'phone_code'); ?>
<?php echo $form->error($model, 'phone_code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'gmt_id'); ?>
<?php echo $form->textField($model, 'gmt_id'); ?>
<?php echo $form->error($model, 'gmt_id'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->