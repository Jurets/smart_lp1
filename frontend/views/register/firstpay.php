<?php $ammount_buff = marketingPlanHelper::init()->getMpParam('price_activation')?>
<p id="shag-3-1-text" > <?php echo BaseModule::t('rec', 'To activate your account, you must make the participation fee of $').' '.$ammount_buff ?></p>
<p class="shag-3-1-sub4"><?php echo BaseModule::t('rec', 'Click this button to login to the PerfectMoney site') ?></p>

<!--<div>
    <input type="button" name="btn" id="btn_pay" class="btn-style-blue btn-style-blue-3-1" value="<?php echo BaseModule::t('common', 'PAY $').' '.$ammount_buff ?>" />
</div>-->

<?php 
$this->renderPartial('pay', array(
    'participant'=>$participant, 
    'tariff'=>Participant::TARIFF_20,
    'amount'=>$ammount_buff,
), false, true); 
?>