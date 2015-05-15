<?php
/*
 * форма для подтверждения оплаты
 */
?>

<p><?php echo BaseModule::t('rec', 'join the club confirm message')?></p><br>

<form action="<?php echo $data['url']?>" method="post">
    <input type="hidden" name="confirmation" value="">
    <input type="submit" value="<?php echo BaseModule::t('rec','NEXT')?>" name="dclub_confirm">
</form>