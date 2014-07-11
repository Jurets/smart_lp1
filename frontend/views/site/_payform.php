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
    <input type="hidden" name="purse_from" value="<?php //От куда пересылаем ?>">
    <input type="hidden" name="recipient_purse" value="<?php //Куда пересылаем ?>">
<?php echo CHtml::submitButton('Оплатить');
echo CHtml::endForm();
?>
