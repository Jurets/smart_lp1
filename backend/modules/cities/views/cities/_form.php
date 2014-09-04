<?php
/* @var $this CitiesController */
/* @var $model Cities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'cities-form',
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
    echo $form->errorSummary(array($model));

    echo $form->dropDownListControlGroup($model, 'country_id', Countries::getCountriesList(), array(
                'class'=>'span5',
                'displaySize'=>'1',
                'prompt'=>ViewHelper::getPrompt('select country'),
    ));
    echo $form->textFieldControlGroup($model, 'name', array('class'=>'span3'));
    
    echo TbHtml::submitButton($model->isNewRecord ? BaseModule::t('rec', 'Create') : BaseModule::t('rec', 'Save'), array('class'=>'primary'));
        
$this->endWidget();                           
?>
</div><!-- form -->