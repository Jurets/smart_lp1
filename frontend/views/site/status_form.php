<?php
/**
 * @var $model
 */
//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style-office.css');

?>
<div class="info">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<div id="main-div">
    <!-- current status -->
    <p><?php echo BaseModule::t('rec', 'Your status').' : '. $status['name'];?></p>

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
                <?php echo CHtml::label('Сумма: ', 'listData');
                echo CHtml::dropDownList('listData', 100, $tariffListData, array('id' => 'dropDownId'));
            } elseif ($model->tariff_id < 2) {
                ?>
                <p><?php echo BaseModule::t('rec', 'First you have to pay $ 50 for registration after that you will be available to Business Club')?></p>
                <input id="sum" type="hidden" value="1">

            <?php
            }
            //вывод формы ввода аккаунта/пароля PM
            $this->renderPartial('application.views.site._payform');
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
    margin-top: -50px;
    height: 230px;
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

</style>
<?php
Yii::app()->clientScript->registerScript(
    'myHideEffect',
    '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
    CClientScript::POS_READY
);
?>