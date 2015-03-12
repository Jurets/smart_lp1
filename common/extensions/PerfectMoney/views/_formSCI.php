<?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'perfectmoney-form',
        'enableAjaxValidation'=>false,
        'action'=>'https://perfectmoney.is/api/step1.asp',
        'method'=>'POST',
    ));
    //$return_url = urldecode(Yii::app()->request->hostInfo . Yii::app()->request->url);
    //$return_url = str_replace(' ', '+', $return_url);
    if (!isset($data['status_url'])) {
        $data['status_url'] = $data['payment_url'];
    }
    if (!isset($data['nopayment_url'])) {
        $data['nopayment_url'] = $data['payment_url'];
    }
    if (!isset($data['currency'])) {
        $data['currency'] = 'USD';
    }
?>
    <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $data['purse']; ?>">
    <input type="hidden" name="PAYEE_NAME" value="JustMoney">
    <input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $data['amount']; ?>">
    <input type="hidden" name="PAYMENT_UNITS" value="<?php echo $data['currency']; ?>">
    <input type="hidden" name="STATUS_URL" value="<?php echo $data['status_url'];?>">
    <input type="hidden" name="PAYMENT_URL" value="<?php echo $data['payment_url'];?>">
    <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $data['nopayment_url'];?>">
    
    <?php 
    if (isset($data['baggage_fields']) && is_array($data['baggage_fields'])) {
        echo CHtml::hiddenField('BAGGAGE_FIELDS', implode(' ', array_keys($data['baggage_fields'])));
        foreach ($data['baggage_fields'] as $fieldname=>$fieldvalue) {
            echo CHtml::hiddenField($fieldname, $fieldvalue);
        }
    } else {
        echo CHtml::hiddenField('BAGGAGE_FIELDS', '');
    }
    ?>
    <!--<input type="hidden" name="BAGGAGE_FIELDS" value="">-->

    <!--<input type="hidden" name="BAGGAGE_FIELDS" value="ORDER_NUM CUST_NUM">
    <input type="hidden" name="ORDER_NUM" value="9801121">
    <input type="hidden" name="CUST_NUM" value="2067609">
    <input type="hidden" name="FORCED_PAYER_ACCOUNT" value="----">-->

    <?php if (isset($submit_button)) {
        echo $submit_button;
    } else { ?>
        <button type="submit" name="PAYMENT_METHOD" value="PerfectMoney account">
            <?php echo BaseModule::t('common', 'PAY $').' '.$amount ?>
        </button>
    <?php } ?>
    
<?php $this->endWidget(); ?>
