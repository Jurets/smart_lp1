<?php
$url = Yii::app()->createAbsoluteUrl('register/activate?activkey=' . $participant->activkey);
?>
<p style="color: #000; font-size: medium;">
    <?php echo BaseModule::t('rec', 'Hello!') ?><br/>
    <?php echo BaseModule::t('rec', 'To confirm registration follow the link') ?> <a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a><br/>
    <?php echo BaseModule::t('rec', 'Do not remove this message until you finally registered.') ?>
    <?php echo BaseModule::t('rec', 'This link is unique and will operate until you pass all registration steps') ?>
</p>
<p><?php echo BaseModule::t('rec', 'Best Regards') ?>, <br/>
    <?php echo BaseModule::t('rec', 'administration') ?> <br/>
    <a target="_blank" href=""><?= CHtml::encode(Yii::app()->name) ?></a></p>