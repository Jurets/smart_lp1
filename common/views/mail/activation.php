<?php
$urlRegister = Yii::app()->createAbsoluteUrl('register/activate?activkey=' . $participant->activkey);
$urlLogin = Yii::app()->createAbsoluteUrl('/');
?>
<p style="color: #000; font-size: medium;">
    <?php echo BaseModule::t('rec', 'Hello!') ?><br/>
    <?php echo BaseModule::t('rec', 'Your account is activated, the system set up an office for you, as you are subscribed to the mailing list of all the news system') ?>
    <?php echo BaseModule::t('rec', 'To go to the office, follow the link') ?> <a href="<?php echo $urlLogin; ?>" target="_blank"><?php echo $urlLogin; ?></a>,
    <?php echo BaseModule::t('rec', 'enter') ?> 
    <strong><?php echo BaseModule::t('rec', 'Login') ?></strong>
    <?php echo BaseModule::t('rec', 'and enter your login information') ?><br>
    <?php echo BaseModule::t('rec', 'login') ?> - <strong><?php echo $participant->email; ?></strong><br>
    <?php echo BaseModule::t('rec', 'password') ?> - <strong><?php echo $pw_original; ?></strong><br>
    <br>
    <?php echo BaseModule::t('rec', 'In order to proceedfollow the link') ?> 
    <a href="<?php echo $urlRegister; ?>" target="_blank"><?php echo $urlRegister; ?></a><br/>
    <?php echo BaseModule::t('rec', 'Do not remove this message until you finally registered.') ?>
    <?php echo BaseModule::t('rec', 'This link is unique and will operate until you pass all registration steps') ?>
</p>
<p><?php echo BaseModule::t('rec', 'Best Regards') ?>,<br/>
    <?php echo BaseModule::t('rec', 'administration site') ?> <br/>
    <a target="_blank" href=""><?= CHtml::encode(Yii::app()->name) ?></a></p>