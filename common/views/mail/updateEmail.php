<?php
/**
 * Created by PhpStorm.
 * Creator: Tkachenko Egor
 * Date: 03.07.14
 * Time: 11:26
 */
    $urlRegister = Yii::app()->createAbsoluteUrl('office/email?activkey=' . $participant->activkey);
?>
<p style="color: #000; font-size: medium;">
    Здравствуйте!<br/>
    Ваш почтовый адрес был изменен на <strong><?php echo $participant->new_email; ?></strong><br>
    <br>
    Для подтверждения новой почты перейдите по ссылке <a href="<?php echo 'http://jwms:8081/office/email'; ?>" target="_blank"><?php echo $urlRegister; ?></a><br/>
    Не удаляйте это письмо, пока не активируете свой почтовый адрес.
    Эта ссылка уникальна и будет действовать, пока вы не пройдете все этапы регистрации
</p>
<p>С уважением, <br/>
    администрация сайта <br/>
    <a target="_blank" href=""><?=CHtml::encode(Yii::app()->name)?></a></p>