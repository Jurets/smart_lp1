<?php
/* @var $this DefaultController */
/* @var $model Information */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
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
        echo $form->errorSummary(array($model));
        //поля
        echo $form->textFieldControlGroup($model, 'id', array('class'=>'span3'));
        echo $form->textFieldControlGroup($model, 'title', array('class'=>'span3'));
        $this->renderPartial('application.views.site.editor', array('form'=>$form, 'model'=>$model, 'field' => 'text'), false, true);
        
        //кнопка сохранения
        echo TbHtml::submitButton($model->isNewRecord ? BaseModule::t('rec', 'Create') : BaseModule::t('rec', 'Save'), array('class'=>'primary'));
        
    $this->endWidget();                           
?>
</div><!-- form -->