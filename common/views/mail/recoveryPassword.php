
<p style="color: #000; font-size: medium;">
    <?php echo BaseModule::t('rec', 'Hello!') ?><br/>
    <?php echo BaseModule::t('rec', 'Your new password is: ') ?> <span><?php echo $password; ?></span><br/>
    
</p>
<p><?php echo BaseModule::t('rec', 'Best Regards') ?>, <br/>
    <?php echo BaseModule::t('rec', 'administration') ?> <br/>
    <a target="_blank" href=""><?= CHtml::encode(Yii::app()->name) ?></a></p>