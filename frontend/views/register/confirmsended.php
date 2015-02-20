<p id="shag-1-3-text" >
   <?php echo $message; ?>
   <a href="<?php echo Yii::app()->createAbsoluteUrl('register/sendmail/userid/' . $participant->id); ?>">
        <br><br><?php echo BaseModule::t('rec', 'IF YOU DO NOT RECEIVE A LETTER') ?>
   </a> 
</p>

<a href="shag-1-4.html" onclick="return false;">
    <input type="button" name="btn" class="btn-style-gray" value="<?php echo BaseModule::t('common', 'NEXT') ?>" />
</a>
