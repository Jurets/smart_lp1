<div id="div-status-form">
<?php
echo CHtml::beginForm('','post');
echo CHtml::label('Введите данные из Perfect Money','');
echo '<br>';
echo CHtml::label('Аккаунт: ','account');
echo CHtml::textField('account');
echo '<br>';
echo CHtml::label('Пароль: ','password');
echo CHtml::textField('password');
echo '<br>';?>
    <input type="hidden" name="amount" id="amount" value="">
    <input type="hidden" name="purse_from" value="<?php //От куда пересылаем ?>">
    <input type="hidden" name="recipient_purse" value="<?php //Куда пересылаем ?>">
<?php echo CHtml::submitButton('Оплатить');
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
        margin-left:35px;
    }
    #div-status-form input{
        margin-top : 10px;
        margin-bottom : 10px;
        height: 35px !important;
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