<?php $ammount_buff = marketingPlanHelper::init()->getMpParam('price_activation'); ?>

<?php if (isset($paysuccess) && $paysuccess == true) { 
    echo CHtml::tag('p', array(), $message);
} else { ?>
    <p id="shag-3-1-text" > <?php echo BaseModule::t('rec', 'To activate your account, you must make the participation fee of $').' '.$ammount_buff ?></p>
    <p class="shag-3-1-sub4"><?php echo BaseModule::t('rec', 'Click this button to login to the PerfectMoney site') ?></p>
<?php } ?>

<!--<div>
    <input type="button" name="btn" id="btn_pay" class="btn-style-blue btn-style-blue-3-1" value="<?php echo BaseModule::t('common', 'PAY $').' '.$ammount_buff ?>" />
</div>-->

<?php 
$this->renderPartial('pay', array(
    'participant'=>$participant, 
    'tariff'=>Participant::TARIFF_20,
    'amount'=>$ammount_buff,
    'paysuccess'=>$paysuccess,
    'message'=>$message,
), false, true); 
?>