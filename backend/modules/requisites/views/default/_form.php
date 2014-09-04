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
        $this->renderPartial('editor', array('form'=>$form, 'model'=>$model, 'field' => 'details'), false, true);
        $this->renderPartial('editor', array('form'=>$form, 'model'=>$model, 'field' => 'agreement'), false, true);
        $this->renderPartial('editor', array('form'=>$form, 'model'=>$model, 'field' => 'marketing'), false, true);
        
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
        
$this->endWidget();                           
        /*$details = $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
                    'model' => $model,
                    'attribute' => 'details',
                    'pluginOptions' => array(
                        'lang' => Yii::app()->language,
                        'toolbar' => true,
                        'iframe' => true,
                    ),), array(), true);
                    
        $agreement = $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
                    'model' => $model,
                    'attribute' => 'agreement',
                    'pluginOptions' => array(
                        'lang' => Yii::app()->language,
                        'toolbar' => true,
                        'iframe' => true,
                    ),), array(), false);

        $marketing = $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
                    'model' => $model,
                    'attribute' => 'marketing',
                    'pluginOptions' => array(
                        'lang' => Yii::app()->language,
                        'toolbar' => true,
                        'iframe' => true,
                    ),), array(), true);*/
                    
       /*$password = $form->textFieldControlGroup($model, 'pw_supervisor', array('class'=>'span3')) .
                   $form->textFieldControlGroup($model, 'pw_admin', array('class'=>'span3')) . 
                   $form->textFieldControlGroup($model, 'pw_moderator', array('class'=>'span3'));

    
    $this->widget('bootstrap.widgets.TbTabs', array(
        'type' => 'tabs',
        'tabs' => array(
                    array(
                        'label' => BaseModule::t('main','О проекте'),
                        'content' => 'ASASAS',// Yii::app()->controller->renderPartial('editor', array('model'=>$model, 'field' => 'details'), true, true), //$details, 
                        'active' => true,
//                        'linkOptions'=>array('width'=>1455,'class'=>'ddddd'),                        
                        ),
                    array(
                        'label' => BaseModule::t('main','Договор оферты'), 
                        'content' => 'asdasdasd', //$agreement,
                        //'id'=>'google_map',
                        //'active'=>true,
                    ),
                    array(
                        'label' => BaseModule::t('main','Текст маркетинг-плана'), 
                        'content' => 'asdasda5768768678678sd', //$marketing,
                        //'id'=>'google_map',
                        //'active'=>true,
                    ),
                    array(
                        'label' => BaseModule::t('main','Безопасность'), 
                        'content' => 'asdas123123123123dasd', //$marketing$password,
                        //'id'=>'google_map',
                        //'active'=>true,
                    ),
        ), 
    ));*/ 
                    
    ?>
</div><!-- form -->