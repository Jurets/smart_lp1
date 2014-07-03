<?php
$url = Yii::app()->createAbsoluteUrl('register/activate?activkey=' . $participant->activkey);
?>
<p style="color: #000; font-size: medium;">
    <?php echo Yii::t('common', 'Hello!') ?><br/>
    <?php echo Yii::t('common', 'To confirm registration follow the link') ?> <a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a><br/>
    <?php echo Yii::t('common', 'Do not remove this message until you finally registered.') ?>
    <?php echo Yii::t('common', 'This link is unique and will operate until you pass all registration steps') ?>
</p>
<p><?php echo Yii::t('common', 'Best Regards') ?>, <br/>
    <?php echo Yii::t('common', 'administration') ?> <br/>
    <a target="_blank" href=""><?= CHtml::encode(Yii::app()->name) ?></a></p>