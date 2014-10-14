<style type="text/css">

    #pm_settings {
        position: absolute;
        top: 432px;
        display: none;
    }


    #pm_settings > input {
        margin-left: 10px;
        margin-right: 10px;
    }

    #pm_settings label {
        margin-right: 10px;
    }    

    .errorpay {
        color: red;
        position: absolute;
        top: 400px;
    }

</style>

<?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'pay-form',
        'enableAjaxValidation'=>false,
    )); 
    echo CHtml::activeHiddenField($participant, 'postedActivKey', array('value'=>$participant->activkey)); 
    echo CHtml::activeHiddenField($participant, 'tariff_id', array('value'=>$tariff));
    echo $form->error($participant, 'tariff_id', array('class'=>'errorpay')); ?>

<div id="pm_settings">
    <?php 
        echo CHtml::label(BaseModule::t('rec', 'Enter your Perfect Money data'), '');
        echo CHtml::label(BaseModule::t('rec', 'Account') . ':','account', '');
        echo CHtml::textField('account','',array('style'=>'width:130px'));
        echo CHtml::label(BaseModule::t('rec', 'password') . ':','password', '');
        echo CHtml::passwordField('password','',array('style'=>'width:130px'));
    ?>
</div>

<a href="">
    <?php echo CHtml::submitButton(BaseModule::t('common', 'Next'), array(
            'name'=>'pay',
            'class'=>($participant->tariff_id >= $tariff ? 'btn-style-green btn-style-green-2-1' : 'btn-style-gray'),
            'style'=>'cursor: pointer;',
            'readonly'=>($participant->tariff_id < $tariff),
            'id'=>'btn_next',
        )); ?>
</a>

<?php $this->endWidget(); ?>

<div><a id="logo" href="index.html"> </a></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btn_pay').click(function(){
            //alert('ЭТО ТЕСТОВЫЙ РЕЖИМ! Нажмите "Далее" для оплаты!');
            $('#pm_settings').show();
            $('#btn_next').attr('class', 'btn-style-green btn-style-green-2-1');
            $('#btn_next').attr('readonly', false);
        });

        $('form#pay-form').submit(function() {
            if ($('#btn_next').attr('readonly'))
                return false;
            else
                return true;
        });

    })
</script>