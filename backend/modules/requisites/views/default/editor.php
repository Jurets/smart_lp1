<?php
    /* @var $this DefaultController */
    /* @var $model Requisites */
    /* @var $form CActiveForm */
?>

<?php
    echo TbHtml::tag('div', array('class'=>'control-group'));
    echo $form->labelEx($model, $field, array('class'=>"control-label"));
    echo TbHtml::tag('div', array('class'=>'controls'));
    
    $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
        'model' => $model,
        'attribute' => $field,
        'pluginOptions' => array(
            'lang' => 'ru',
            'toolbar' => true,
            'iframe' => true,
        ),));
        
    echo $form->error($model, $field);
    echo TbHtml::closeTag('div');
?>
<hr>
