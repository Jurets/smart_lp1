<?php
    /* @var $this UserController */
    /* @var $model User */
    /* @var $form bootstrap.widgets.TbActiveForm */
?>


<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>true,
            'htmlOptions' => array('enctype'=>'multipart/form-data'),
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        ));
      //вьюшка для сообщения о необходимых полях
        echo $this->renderPartial('backend.views.site.required');
        
      //сборник ошибок
        echo $form->errorSummary(array($model/*,$profile*/));
        
      //поля модели
        echo $form->dropDownListControlGroup($model, 'status', User::itemAlias('UserStatus'), array('displaySize'=>'1', 'prompt'=>'<выбор>',));  //активность
        echo $form->dropDownListControlGroup($model, 'superuser', User::itemAlias('AdminStatus'), array('displaySize'=>'1', 'prompt'=>'<выбор>',)); //суперадмин

        echo $form->textFieldControlGroup($model, 'username', array('class'=>'span3')); //логин
        echo $form->textFieldControlGroup($model, 'password', array('class'=>'span3')); //пароль
        echo $form->textFieldControlGroup($model, 'email', array('class'=>'span3'));    //эл.почта

        echo $form->textFieldControlGroup($model, 'first_name', array('class'=>'span5'));  //имя
        echo $form->textFieldControlGroup($model, 'last_name', array('class'=>'span5'));   //фамилия
        
        //дата рождения
        echo TbHtml::tag('div', array('class'=>'control-group'));
            echo $form->labelEx($model, 'dob', array('class'=>"control-label"));
            echo TbHtml::tag('div', array('class'=>'controls'));
                $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                    'model' => $model,
                    'name' => 'dob',
                    'attribute' => 'dob',
                    'format' => 'yyyy-MM-dd',
                ));
                echo $form->error($model, 'dob');
            echo TbHtml::closeTag('div');
        echo TbHtml::closeTag('div');

        //страна / город
        echo $form->dropDownListControlGroup($model, 'country_id', Countries::getCountriesList(), array(
                'id'=>'Participant_country_id',
                'class'=>'span5',
                'displaySize'=>'1',
                'prompt'=>ViewHelper::getPrompt('select country'),
                'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('dynamiccities'), //url to call.
                    'data'=>array('country_id'=>'js:this.value'),
                    'update'=>'#Participant_city_id',
                 ),
        ));
        echo $form->dropDownListControlGroup($model, 'city_id', Cities::getCitiesListByCountry(), array(
                'id'=>'Participant_city_id',
                'class'=>'span5',
                'displaySize'=>'1',
                'prompt'=>ViewHelper::getPrompt('select city'),
        ));
        
        //временная зона (часовой пояс)
        echo $form->dropDownListControlGroup($model, 'gmt_id', Gmt::getTimezonesList(), array(
                'class'=>'span5',
                'displaySize'=>'1',
                'prompt'=>ViewHelper::getPrompt('select timezone'),
        )); 
        
        echo $form->textFieldControlGroup($model, 'phone', array('class'=>'span5'));   //телефон
        echo $form->textFieldControlGroup($model, 'skype', array('class'=>'span5'));   //скайп
        
      //кнопка сохранения
        echo TbHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'), array('class'=>'primary'));
        
$this->endWidget(); ?>

</div>