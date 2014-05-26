<?php
    /* @var $this InvitationController */
    /* @var $model Invitation */
    /* @var $form CActiveForm */
?>


<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'invitation-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            //'action'=>Yii::app()->createUrl($this->route),
            //'method'=>'get',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); 
            //вьюшка для сообщения о необходимых полях
            echo $this->renderPartial('backend.views.site.required');
        
            echo $form->errorSummary($model);
        
            echo $form->textFieldControlGroup($model, 'video_link', array('class'=>'span9'));
            echo $form->textFieldControlGroup($model, 'file', array('class'=>'span7'));
            echo $form->textFieldControlGroup($model, 'file_link', array('class'=>'span9'));

            //кнопка сохранения
            echo TbHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'), array('class'=>'primary'));

        $this->endWidget(); 
    ?>

</div>