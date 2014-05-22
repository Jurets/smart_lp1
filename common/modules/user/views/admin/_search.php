<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'get',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); 

            echo $form->textFieldControlGroup($model, 'id', array('class'=>'span1'));
            echo $form->textFieldControlGroup($model, 'create_at', array('class'=>'span3'));
            echo $form->textFieldControlGroup($model, 'username', array('class'=>'span3'));
            echo $form->textFieldControlGroup($model, 'first_name', array('class'=>'span5'));
            echo $form->textFieldControlGroup($model, 'last_name', array('class'=>'span5'));
            //здесь будут город и страна
            echo $form->dropDownListControlGroup($model, 'country_id', TbHtml::listData(Countries::model()->findAll(), 'name', 'name'), array(
                'class'=>'span5',
                'displaySize'=>'1',
                'prompt'=>'<выбрать страну>',
            ));
            echo $form->textFieldControlGroup($model, 'phone', array('class'=>'span4'));
            echo $form->textFieldControlGroup($model, 'skype', array('class'=>'span4'));
            echo $form->textFieldControlGroup($model, 'email', array('class'=>'span5'));
            //здесь будут рефер

            echo TbHtml::submitButton(UserModule::t('Search'));

        $this->endWidget(); 
    ?>

</div><!-- search-form -->