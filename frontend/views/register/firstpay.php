<style type="text/css">
    #pm_settings {
        position: absolute;
        top: 432px;
        display: none;
    }
    #pm_settings > input {
        margin-left: 10px;
        margin-right: 10px;
    }
    #pm_settings label {
        margin-right: 10px;
    }    
    .errorpay {
        color: red;
        position: absolute;
        top: 400px;
    }
    
    .btn-style-blue-4-1 {
        top: 400px;
    }    

    .btn-style-blue-4-1:hover {
        top: 400px;
    }    
</style>

<?php //$ammount_buff = marketingPlanHelper::init()->getMpParam('price_activation'); ?>

<?php if (isset($paysuccess) && $paysuccess == true) { 
    echo CHtml::tag('p', array('id'=>"shag-3-1-text"), $message);
} else { 
    echo $instruction;
?>
    <!--<p id="shag-3-1-text"> <?php echo BaseModule::t('rec', 'To activate your account, you must make the participation fee of $').' '.$amount ?></p>-->
    <p class="shag-3-1-sub4"><?php echo BaseModule::t('rec', 'Click this button to login to the PerfectMoney site') ?></p>

    <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'perfectmoney-form',
            'enableAjaxValidation'=>false,
            'action'=>'https://perfectmoney.is/api/step1.asp',
            'method'=>'POST',
        ));
        $return_url = urldecode(Yii::app()->request->hostInfo . Yii::app()->request->url);
        $return_url = str_replace(' ', '+', $return_url);
    ?>
        <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $purse; ?>">
        <input type="hidden" name="PAYEE_NAME" value="JustMoney">
        <input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $amount; ?>">
        <input type="hidden" name="PAYMENT_UNITS" value="USD">
        <input type="hidden" name="STATUS_URL" value="<?php echo $return_url;?>">
        <input type="hidden" name="PAYMENT_URL" value="<?php echo $return_url;?>">
        <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $return_url;?>">
        <input type="hidden" name="BAGGAGE_FIELDS" value="">

        <!--<input type="hidden" name="BAGGAGE_FIELDS" value="ORDER_NUM CUST_NUM">
        <input type="hidden" name="ORDER_NUM" value="9801121">
        <input type="hidden" name="CUST_NUM" value="2067609">
        <input type="hidden" name="FORCED_PAYER_ACCOUNT" value="<?php echo $participant->purse; ?>">-->

        <button type="submit" name="PAYMENT_METHOD" value="PerfectMoney account" class="btn-style-blue btn-style-blue-<?php echo $this->step; ?>-1">
            <?php echo BaseModule::t('common', 'PAY $').' '.$amount ?>
        </button>
    <?php $this->endWidget(); ?>

<?php } ?>

<?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'pay-form',
        'enableAjaxValidation'=>false,
        'method'=>'POST',
    ));    
    echo CHtml::activeHiddenField($participant, 'postedActivKey', array('value'=>$participant->activkey)); 
    echo CHtml::activeHiddenField($participant, 'tariff_id', array('value'=>$tariff));
    echo $form->error($participant, 'tariff_id', array('class'=>'errorpay')); 
    
    $htmlOptions = array(
        'name'=>'pay',
        'class'=>($paysuccess ? 'btn-style-green btn-style-green-2-1' : 'btn-style-gray'),
        'style'=>'cursor: pointer;',
        'id'=>'btn_next',
    );
    if (!$paysuccess) {
        $htmlOptions['readonly'] = 'readonly';
    }
    echo CHtml::submitButton(BaseModule::t('common', 'Next'), $htmlOptions); 
$this->endWidget(); ?>

<div>
    <a id="logo" href="index.html"> </a>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('form#pay-form').submit(function() {
            if ($('#btn_next').attr('readonly'))
                return false;
            else
                return true;
        });
    })
</script>