<?php
/* @var $this TrainingController */
/* @var $model Training */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
<?php echo $form->label($model, 'id'); ?>
<?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'title'); ?>
<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'description'); ?>
<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'image'); ?>
<?php echo $form->textField($model, 'image', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'videolink'); ?>
<?php echo $form->textField($model, 'videolink', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'date'); ?>
<?php echo $form->textField($model, 'date'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'number'); ?>
<?php echo $form->textField($model, 'number'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton(BaseModule::t('common', 'Search')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->