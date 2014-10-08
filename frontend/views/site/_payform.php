<div id="div-status-form">
    <?php
        echo CHtml::beginForm('','post');
        echo CHtml::label(BaseModule::t('rec', 'Enter your Perfect Money data'),'');
        echo '<br>';
        echo CHtml::label(BaseModule::t('rec', 'Account').':','account');
        echo CHtml::textField('account');
        echo '<br>';
        echo CHtml::label(BaseModule::t('rec', 'Password').':','password');
        echo CHtml::passwordField('password');
        echo '<br>';?>
    <input type="hidden" name="amount" id="amount" value="">
    <input type="hidden" name="purse_from" value="<?php //От куда пересылаем ?>">
    <input type="hidden" name="recipient_purse" value="<?php //Куда пересылаем ?>">
    <?php 
        echo CHtml::submitButton(BaseModule::t('rec', 'Pay'));
        echo CHtml::endForm();
    ?>
</div>

<style>
    #cost{
        margin-left:20px;
    }
    #account{
        margin-left:30px;
    }
    #password{
        margin-left:36px;
    }
    #div-status-form input{
        margin-top : 10px;
        margin-bottom : 10px;
        height: 35px !important;
    }
    #div-status-form input[type='submit']{
        height: 25px !important;
        padding-top: 0px;
        padding-bottom: 35px;
    }
</style>
<script>
    if(document.getElementById('dropDownId')){
        $('#dropDownId').change(function(){
            var valueList = $('#dropDownId :selected').val();
            document.getElementById('amount').value = valueList;
        });
        $('#dropDownId').change();
    }
    else{
        $('#amount').val($('#sum').val());
    }
</script>