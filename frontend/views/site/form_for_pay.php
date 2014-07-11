<?php
/**
 * Created by PhpStorm.
 * User: 204-2
 * Date: 11.07.14
 * Time: 16:57
 */


echo CHtml::beginForm('','post');
echo CHtml::label('Login: ','login');
echo CHtml::textField('login');
echo '<br>';
echo CHtml::label('Password: ','password');
echo CHtml::textField('password');
echo '<br>';?>
    <input type="hidden" name="purse_from" value="<?php //От куда пересылаем ?>">
    <input type="hidden" name="recipient_purse" value="<?php //Куда пересылаем ?>">
<?php echo CHtml::submitButton('Оплатить');
echo CHtml::endForm();
?>