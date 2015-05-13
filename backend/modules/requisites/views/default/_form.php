<?php
/* @var $this DefaultController */
/* @var $model Requisites */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $hr = TbHtml::tag('hr', array(), false, true);
    
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'requisites-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    ));
        //вьюшка для сообщения о необходимых полях
        echo $this->renderPartial('backend.views.site.required');
        //сборник ошибок
        echo $form->errorSummary(array($model/*,$profile*/));

        //поля
        $this->renderPartial('application.views.site.editor', array('form'=>$form, 'model'=>$model, 'field' => 'details'), false, true);
        $this->renderPartial('application.views.site.editor', array('form'=>$form, 'model'=>$model, 'field' => 'agreement'), false, true);
        $this->renderPartial('application.views.site.editor', array('form'=>$form, 'model'=>$model, 'field' => 'marketing'), false, true);
        

        echo $form->textFieldControlGroup($model, 'pw_supervisor', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'pw_admin', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'pw_moderator', array('class'=>'span3'));
        echo $hr;
        
        echo $form->textFieldControlGroup($model, 'purse_activation', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'purse_club', array('class'=>'span3'));
        
        echo $form->textFieldControlGroup($model, 'bpm_login', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'bpm_password', array('class'=>'span3'));
        
        //echo $form->textFieldControlGroup($model, 'purse_investor', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'purse_fdl', array('class'=>'span3'));
        
        //кошелек автоклуба - для процесса вступления B1 - без приглашенных
        echo $form->textFieldControlGroup($model, 'purse_autoclub', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'autoclub_login', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'autoclub_password', array('class'=>'span3'));
        
        //выбор супер-рефера
        $user = Participant::model()->findByPk(Yii::app()->user->id);
        echo $form->dropDownListControlGroup($model, 'superrefer_id', $user->getListForSuperReferalSelect(), array(
                //'id'=>'Participant_city_id',
                'class'=>'span5',
                'displaySize'=>'1',
                'prompt'=>ViewHelper::getPrompt('select super referal'),
        ));
                       
        //кнопка сохранения
        echo TbHtml::submitButton($model->isNewRecord ? BaseModule::t('rec', 'Create') : BaseModule::t('rec', 'Save'), array('class'=>'primary'));
        
$this->endWidget(); ?>
</div>
