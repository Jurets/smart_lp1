<?php
    $url = Yii::app()->createAbsoluteUrl('register/activate?activkey=' . $participant->activkey);
?>
<p style="color: #000; font-size: medium;">
    Здравствуйте!<br/>
    Для подтверждения регистрации перейдите по ссылке <a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a><br/>
</p>
<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href=""><?=CHtml::encode(Yii::app()->name)?></a></p>