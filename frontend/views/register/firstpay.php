<p id="shag-3-1-text" > <?php echo Yii::t('common', 'To activate your account, you must make the participation fee of $ 20') ?></p>
<!--<p class="shag-3-1-sub4"><?php echo Yii::t('common', 'ou will pass on website payment system to pay') ?></p>-->
<p class="shag-3-1-sub4"><?php echo Yii::t('common', 'Нажмите эту кнопку для авторизации на сайте PerfectMoney') ?></p>

<div>
    <input type="button" name="btn" id="btn_pay" class="btn-style-blue btn-style-blue-3-1" value="<?php echo Yii::t('common', 'PAY $ 20') ?>" />
</div>

<?php $this->renderPartial('pay', array('participant'=>$participant, 'tariff'=>Participant::TARIFF_20), false, true); ?>