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
        echo $this->renderPartial('backend.views.site.required');?>
        <input name="dateInitOff" type="hidden" value="1">
        <?php
      //сборник ошибок
        echo $form->errorSummary(array($model/*,$profile*/));
        
      //поля модели
        echo $form->dropDownListControlGroup($model, 'status', User::itemAlias('UserStatus'), array('displaySize'=>'1', 'prompt'=>'<выбор>',));  //активность
       // echo $form->dropDownListControlGroup($model, 'superuser', User::itemAlias('AdminStatus'), array('displaySize'=>'1', 'prompt'=>'<выбор>',)); //суперадмин
        
        //выпадающий список выбора статуса пользователя.
        
        // create section
        if( $model->tariff_id == 0 ){ // неизвестный вид пользователя - create
            echo $form->dropDownListControlGroup($model, 'bot', $model->bot, 
                array(
                        'displaySize'=>'1','class'=>'span3',
                        'prompt'=>  BaseModule::t('rec', '--'),
                        'options' => array(
                            $model->tariff_id => array(
                                'selected'=>'true'
                            )
                        )
                    )
                );
        }
        
        // edit section
        
        if($model->tariff_id > 0 && $model->tariff_id < Participant::BOT_50) { // это живой юзер - никаких ботов
            echo $form->dropDownListControlGroup($model, 'bot', [], 
                array(
                        'displaySize'=>'1','class'=>'span3',
                        'prompt'=>  BaseModule::t('rec', '--'),
                        'options' => array(
                            $model->tariff_id => array(
                                'selected'=>'true'
                            )
                        )
                    )
                );
        } else if($model->tariff_id > 0 && $model->tariff_id >= Participant::BOT_50) { // тут уже боты, unset задает необратимость изменения статусов
            // add any bot statuses - here
            if($model->tariff_id == Participant::BOT_BC_BRONZE){
                unset($model->bot[Participant::BOT_50]);
            }
        echo $form->dropDownListControlGroup($model, 'bot', $model->bot, 
                array(
                        'displaySize'=>'1','class'=>'span3',
                        //'prompt'=>  BaseModule::t('rec', 'Yes'),
                        'options' => array(
                            $model->tariff_id => array(
                                'selected'=>'true'
                            )
                        )
                    )
                ); // на самом деле это Нет - при переводе перепутали
        }
        
        echo $form->textFieldControlGroup($model, 'username', array('class'=>'span3')); //логин
        echo $form->textFieldControlGroup($model, 'password', array('class'=>'span3')); //пароль
        echo $form->textFieldControlGroup($model, 'email', array('class'=>'span3'));    //эл.почта

        echo $form->textFieldControlGroup($model, 'first_name', array('class'=>'span5'));  //имя
        echo $form->textFieldControlGroup($model, 'last_name', array('class'=>'span5'));   //фамилия

        echo TbHtml::tag('div', array('class'=>'control-group'));
        echo $form->labelEx($model, 'income', array('class'=>"control-label"));
        echo TbHtml::tag('div', array('class'=>'controls'));
        echo $form->numberField($model, 'income', array('class'=>'span5'));  // доход
        echo $form->error($model, 'income');
        echo TbHtml::closeTag('div');
        echo TbHtml::closeTag('div');
        echo TbHtml::tag('div', array('class'=>'control-group'));
        echo $form->labelEx($model, 'transfer_fund', array('class'=>"control-label"));
        echo TbHtml::tag('div', array('class'=>'controls'));
        echo $form->numberField($model, 'transfer_fund', array('class'=>'span5'));   // отчисления в фонд
        echo $form->error($model, 'transfer_fund');
        echo TbHtml::closeTag('div');
        echo TbHtml::closeTag('div');
        
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
        echo $form->dropDownListControlGroup($model, 'city_id', Cities::getCitiesListByCountry($model->country_id), array(
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

        //участник-реферал (ссылка на того, кто пригласил)
        echo $form->dropDownListControlGroup($model, 'refer_id', $model->listForReferalSelect, array(
                'class'=>'span5',
                'displaySize'=>'1',
                'prompt'=>ViewHelper::getPrompt('select referal'),
        )); 
        
      //кнопка сохранения
        echo TbHtml::submitButton($model->isNewRecord ? BaseModule::t('rec', 'Create') : BaseModule::t('rec', 'Save'), array('class'=>'primary'));
        
$this->endWidget(); ?>

</div>