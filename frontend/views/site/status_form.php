<?php
/**
 * @var $model
 */
//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style-office.css');

?>
<div class="info">
    <?php echo Yii::app()->user->getFlash('success');?>
    <?php echo Yii::app()->user->getFlash('fail'); ?>
</div>
<div id="main-div">
    <!-- current status -->
    <p><?php echo BaseModule::t('rec', 'Your status').' : '. BaseModule::t('rec', $status['name']);?></p>

    <?php
    if (!$defective_status) {
        if ($max_status) {
            ?>
            <br>
            <p><?php echo BaseModule::t('rec', 'You have reached the maximum status in the Business Club')?>!</p>
        <?php
        } else {
            if ($model->tariff_id >= 2) {
                ?>
                <p><?php echo BaseModule::t('rec', 'To raise your status you must pay payment')?></p>
                <?php echo CHtml::label(BaseModule::t('rec', 'Amount').': ', 'listData');
                $amount = current($tariffListData);
                echo CHtml::dropDownList('listData', 100, $tariffListData, array('id' => 'dropDownId'));
            } elseif ($model->tariff_id < 2) {
                $amount = Requisites::purseClub(); ?>
                <p><?php echo BaseModule::t('rec', 'First you have to pay $ 50 for registration after that you will be available to Business Club')?></p>
                <!--<input id="sum" type="hidden" value="1">-->

            <?php
            }
            //вывод формы ввода аккаунта/пароля PM
            ///////$this->renderPartial('application.views.site._payform');
            
            //вывод формы SCI
            $return_url = urldecode(Yii::app()->request->hostInfo . Yii::app()->request->url);
            $data = array(
                'purse'=>Requisites::purseClub(),
                'amount'=>$amount, //current($tariffListData),
                'currency'=>'USD',
                'payment_url'=>$return_url /*. '?response=success'*/,
                'nopayment_url'=>$return_url /*. '?response=cancel'*/,
                'baggage_fields'=>array('tariffid'=>key($tariffListData)),
            );
            $this->renderPartial('common.extensions.PerfectMoney.views._formSCI', array(
                'data'=>$data,
                'submit_button'=>CHtml::submitButton(BaseModule::t('rec', 'Pay')),
            ));
        }
    } else {
        ?>
        <p><?php if($message != ''){echo $message;}?></p>
        <br>
        <p><?php echo BaseModule::t('rec', 'The payment system is not available now')?></p>
    <?php
    }
    ?>
</div>

<style>
.info{
    position: absolute;
    top:110px;
}
#main-div{
    position: absolute;
    top:150px;
}
div#darkBGG{
    display: none;
}

div#whiteBG{
    display: none;
}

div.footer{
    margin-top: 0px;
    height: 240px;
    padding-top: 58px;
}
div.footer #footer{
    top: 0;
}

div#contentBG{
    height: 930px;
}

div#footer-bark-bg{
    top: 0px;
}

.moveRight2 {
    background-position: 80px;
}

a#endText {
    left: 182px;
}

input[type='submit']{
    height: 25px !important;
    padding-top: 0px;
    padding-bottom: 35px;
}

</style>
<?php
    $sc = '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");
           $("#dropDownId").change(function(){
                amount = $("#dropDownId option:selected").text();
                $("input[name=\'PAYMENT_AMOUNT\']").val(amount);
                tariffId = $("#dropDownId option:selected").val();
                $("input[name=\'tariffid\']").val(tariffId);
           })
    ';

    Yii::app()->clientScript->registerScript(
        'myHideEffect',
        $sc,
        CClientScript::POS_READY
    );
?>