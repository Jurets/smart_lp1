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
    <?php echo Yii::t('common', 'Hello!') ?><br/>
    <?php echo Yii::t('common', 'Your e-mail has been changed to') ?> <strong><?php echo $participant->new_email; ?></strong><br>
    <br>
    <?php echo Yii::t('common', 'To confirm registration follow the link') ?> <a href="<?php echo 'http://jwms:8081/office/email'; ?>" target="_blank"><?php echo $urlRegister; ?></a><br/>
    <?php echo Yii::t('common', 'Do not remove this message until you finally registered.') ?>
    <?php echo Yii::t('common', 'This link is unique and will operate until you pass all registration steps') ?>
</p>
<p><?php echo Yii::t('common', 'Best Regards') ?>, <br/>
    <?php echo Yii::t('common', 'administration') ?> <br/>
    <a target="_blank" href=""><?= CHtml::encode(Yii::app()->name) ?></a></p>