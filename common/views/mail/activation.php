<?php
    $urlRegister = Yii::app()->createAbsoluteUrl('register/activate?activkey=' . $participant->activkey);
    $urlLogin = Yii::app()->createAbsoluteUrl('/');
?>
<p style="color: #000; font-size: medium;">
    Здравствуйте!<br/>
    Ваш аккаунт активирован, в системе создан офис для Вас, также Вы подписаны на почтовую рассылку всех новостей системы
    Чтобы зайти в офис, перейдите по ссылке <a href="<?php echo $urlLogin; ?>" target="_blank"><?php echo $urlLogin; ?></a>,
    нажмите <strong>Вход</strong> и введите свои данные для входа:<br>
    логин - <strong><?php echo $participant->email; ?></strong><br>
    пароль - <strong><?php echo $participant->password; ?></strong><br>
    <br>
    Для продолжения регистрации перейдите по ссылке <a href="<?php echo $urlRegister; ?>" target="_blank"><?php echo $urlRegister; ?></a><br/>
    Не даляйте это письмо, пока окончательно не зарегистрируетесь.
    Эта ссылка уникальна и будет действовать, пока вы не пройдете все этапы регистрации
</p>
<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href=""><?=CHtml::encode(Yii::app()->name)?></a></p>