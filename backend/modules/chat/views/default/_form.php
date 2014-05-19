<?php
/* @var $this ChatController */
/* @var $model Chatmessage */
/* @var $form TbActiveForm */
?>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'chat-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Поля, помеченные <span class="required">*</span>, являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('rows' => 8, 'cols' => 100)); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'created'); ?>
        <?php echo $form->textField($model, 'created'); ?>
        <?php /*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'model'=>$model,
                    'attribute'=>'created',
                    'language'=>'ru',
                    'defaultOptions'=>array(
                        'showAnim'=>'fadeIn',
                        'dateFormat'=>'yyyy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'constrainInput' => 'true',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;',
                        'value'=>Yii::app()->dateFormatter->format("yyyy-MM-dd HH:mm:ss", date("Y-m-d h:m:s", $model->created)),
                        //'value'=>Yii::app()->dateFormatter->format("dd.MM.yyyy", $model->created - DataHelper::get_timezone_offset(Yii::app()->user->id->userTimezone, date_default_timezone_get())),
                        //'value'=>DataHelper::formattedDate($model->created - DataHelper::get_timezone_offset(Yii::app()->user->id->userTimezone, date_default_timezone_get())),
                    ),
                ));*/ ?>
        <?php echo $form->error($model,'created'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_alert'); ?>
        <?php echo $form->checkBox($model, 'is_alert'); ?>
        <?php echo $form->error($model, 'is_alert'); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div>