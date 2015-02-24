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

</style>

<?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'perfectmoney-form',
        'enableAjaxValidation'=>false,
        'action'=>'https://perfectmoney.is/api/step1.asp',
        'method'=>'POST',
    )); //DebugBreak();
    $return_url = Yii::app()->request->hostInfo . Yii::app()->request->url;
    //echo CHtml::activeHiddenField($participant, 'postedActivKey', array('value'=>$participant->activkey)); 
    //echo CHtml::activeHiddenField($participant, 'tariff_id', array('value'=>$tariff));
    //echo $form->error($participant, 'tariff_id', array('class'=>'errorpay')); ?>

    <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo Requisites::purseActivation(); ?>">
    <input type="hidden" name="PAYEE_NAME" value="JustMoney">
    <!--<input type="hidden" name="FORCED_PAYER_ACCOUNT" value="<?php echo $participant->purse; ?>">-->
    <input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $amount; ?>">
    <input type="hidden" name="PAYMENT_UNITS" value="USD">
    <input type="hidden" name="STATUS_URL" value="">
    <!--<input type="hidden" name="PAYMENT_URL" value="http://jwms.my/register/activate?activkey=<?php echo $participant->activkey;?>">-->
    <input type="hidden" name="PAYMENT_URL" value="<?php echo $return_url;?>">
    <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $return_url;?>">
    <!--<input type="hidden" name="PAYMENT_URL" value="http://justmoney.pro/register/activate?activkey=<?php echo $participant->activkey;?>">
    <input type="hidden" name="NOPAYMENT_URL" value="http://justmoney.pro/register/activate?activkey=<?php echo $participant->activkey;?>">-->
    <input type="hidden" name="BAGGAGE_FIELDS" value="">
    
    <!--<input type="hidden" name="BAGGAGE_FIELDS" value="ORDER_NUM CUST_NUM">
    <input type="hidden" name="ORDER_NUM" value="9801121">
    <input type="hidden" name="CUST_NUM" value="2067609">-->
    
    <!--<input type="submit" name="PAYMENT_METHOD" value="PerfectMoney account">-->
    
<!--<div id="pm_settings">
    <?php 
        //echo CHtml::label(BaseModule::t('rec', 'Enter your Perfect Money data'), '');
        //echo CHtml::label(BaseModule::t('rec', 'Account') . ':','account', '');
        //echo CHtml::textField('account','',array('style'=>'width:130px'));
        //echo CHtml::label(BaseModule::t('rec', 'password') . ':','password', '');
        //echo CHtml::passwordField('password','',array('style'=>'width:130px'));
    ?>
</div>-->

<!--<a href="">
    <div>-->
        <!--<input type="button" name="btn" id="btn_pay" class="btn-style-blue btn-style-blue-3-1" value="<?php echo BaseModule::t('common', 'PAY $').' '.$amount ?>" />-->
        <button type="submit" name="PAYMENT_METHOD" value="PerfectMoney account" class="btn-style-blue btn-style-blue-3-1">
            <?php echo BaseModule::t('common', 'PAY $').' '.$amount ?>
        </button>
    <!--</div>-->
<?php $this->endWidget(); ?>

    <!--<button type="submit" name="PAYMENT_METHOD" value="PerfectMoney account" class="btn-style-green btn-style-green-2-1" style="cursor: pointer;" id="btn_next">
        <?php echo BaseModule::t('common', 'Next'); ?>
    </button>-->
    
    <?php 
$form = $this->beginWidget('CActiveForm', array(
        'id'=>'pay-form',
        'enableAjaxValidation'=>false,
        //'action'=>'https://perfectmoney.is/api/step1.asp',
        'method'=>'POST',
    ));    
    echo CHtml::submitButton(BaseModule::t('common', 'Next'), array(
    //echo CHtml::button(BaseModule::t('common', 'Next'), array(
            'name'=>'pay',
            'class'=>($participant->tariff_id >= $tariff ? 'btn-style-green btn-style-green-2-1' : 'btn-style-gray'),
            //'class'=>'btn-style-green btn-style-green-2-1',
            'style'=>'cursor: pointer;',
            'readonly'=>($participant->tariff_id < $tariff),
            'id'=>'btn_next',
            //"value"=>"PerfectMoney account",
    )); ?>
<!--</a>-->

<?php $this->endWidget(); ?>

<div><a id="logo" href="index.html"> </a></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btn_pay').click(function(){
            //alert('ЭТО ТЕСТОВЫЙ РЕЖИМ! Нажмите "Далее" для оплаты!');
            $('#pm_settings').show();
            $('#btn_next').attr('class', 'btn-style-green btn-style-green-2-1');
            $('#btn_next').attr('readonly', false);
        });

        $('form#pay-form').submit(function() {
            if ($('#btn_next').attr('readonly'))
                return false;
            else
                return true;
        });

    })
</script>