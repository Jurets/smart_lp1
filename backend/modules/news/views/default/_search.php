<?php
/* @var $this NewsController */
/* @var $model News */
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
        <?php //echo $form->label($model,'id');  ?>
        <?php //echo $form->textField($model,'id');  ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, BaseModule::t('common', 'Author')); ?>
        <?php echo $form->textField($model, 'author'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, BaseModule::t('common', 'Created')); ?>
        <?php echo $form->textField($model, 'created'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, BaseModule::t('common', 'Activated')); ?>
        <?php echo $form->textField($model, 'activated'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, BaseModule::t('common', 'Title')); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 75)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, BaseModule::t('common', 'Announcement')); ?>
        <?php echo $form->textField($model, 'announcement', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, BaseModule::t('common', 'Сontent')); ?>
        <?php echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php //echo $form->label($model,'image');  ?>
        <?php //echo $form->textField($model,'image',array('size'=>15,'maxlength'=>15));  ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, BaseModule::t('common', 'Activity')); ?>
        <?php echo $form->textField($model, 'activity'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(BaseModule::t('common', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->