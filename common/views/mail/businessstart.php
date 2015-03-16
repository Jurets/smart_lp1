<p style="color: #000; font-size: medium;">
    <?php echo BaseModule::t('rec', 'Hello!') ?><br/>
    <?php echo BaseModule::t('rec', 'Congratulations on your purchase Business Start! Registration is fully passed.') ?>
    <?php echo BaseModule::t('rec', 'Now login information will be used only your email and password.') ?>
    <?php echo BaseModule::t('rec', 'login') ?> - <strong><?php echo $participant->email; ?></strong><br>
    <?php echo BaseModule::t('rec', 'password') ?> - <strong><?php echo $pw_original; ?></strong><br>
</p>
<p><?php echo BaseModule::t('rec', 'Best Regards') ?>, <br/>
    <?php echo BaseModule::t('rec', 'administration') ?> <br/>
    <a target="_blank" href=""><?= CHtml::encode(Yii::app()->name) ?></a></p>