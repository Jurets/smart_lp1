<?php
/*
 * форма для оплаты всей суммы на автоклуб
 */
?>

<p><?php echo BaseModule::t('rec', 'directly in club invitation')?></p>
<p><?php echo BaseModule::t('rec', 'you need to pay').' '?>&dollar;<?php echo $data['amount']?></p><br>


<form method="POST" action="https://perfectmoney.is/api/step1.asp">
    <input type="hidden" value="<?php echo $data['purse_autoclub'] ?>" name="PAYEE_ACCOUNT">
    <input type="hidden" value="DirectlyinClub" name="PAYEE_NAME">
    <input type="hidden" value="<?php echo $data['amount']?>" name="PAYMENT_AMOUNT">
    <input type="hidden" value="<?php echo $data['currency']?>" name="PAYMENT_UNITS">
    <input type="hidden" value="<?php echo $data['url']?>" name="STATUS_URL">
    <input type="hidden" value="<?php echo $data['url']?>" name="PAYMENT_URL">
    <input type="hidden" value="<?php echo $data['url']?>" name="NOPAYMENT_URL">
    
    <input type="submit" value="<?php echo BaseModule::t('rec','Pay')?>" name="dclub_pay">    
</form>