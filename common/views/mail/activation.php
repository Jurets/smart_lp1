<?php
$urlRegister = Yii::app()->createAbsoluteUrl('register/activate?activkey=' . $participant->activkey);
$urlLogin = Yii::app()->createAbsoluteUrl('/');
?>
<p style="color: #000; font-size: medium;">
    <?php echo Yii::t('common', 'Hello!') ?><br/>
    <?php echo Yii::t('common', 'Your account is activated, the system set up an office for you, as you are subscribed to the mailing list of all the news system') ?>
    <?php echo Yii::t('common', 'To go to the office, follow the link') ?> <a href="<?php echo $urlLogin; ?>" target="_blank"><?php echo $urlLogin; ?></a>,
    <?php echo Yii::t('common', 'enter') ?> 
    <strong><?php echo Yii::t('common', 'Login') ?></strong>
    <?php echo Yii::t('common', 'and enter your login information') ?><br>
    <?php echo Yii::t('common', 'login') ?> - <strong><?php echo $participant->email; ?></strong><br>
    <?php echo Yii::t('common', 'password') ?> - <strong><?php echo $pw_original; ?></strong><br>
    <br>
    <?php echo Yii::t('common', 'In order to proceedfollow the link') ?> 
    <a href="<?php echo $urlRegister; ?>" target="_blank"><?php echo $urlRegister; ?></a><br/>
    <?php echo Yii::t('common', 'Do not remove this message until you finally registered.') ?>
    <?php echo Yii::t('common', 'This link is unique and will operate until you pass all registration steps') ?>
</p>
<p><?php echo Yii::t('common', 'Best Regards') ?>,<br/>
    <?php echo Yii::t('common', 'administration site') ?> <br/>
    <a target="_blank" href=""><?= CHtml::encode(Yii::app()->name) ?></a></p>