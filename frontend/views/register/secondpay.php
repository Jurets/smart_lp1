<p id="shag-4-1-text" > <?php echo Yii::t('common', 'Congratulations! You are already logged in!') ?> <br>
    <br><?php echo Yii::t('common', 'Now, to become a party to a business, you must pass the final step.') ?><br>
    <?php echo Yii::t('common', 'Business participation will allow you to get so many things and so many things! Do not waste time!') ?> </p>
<!--<p class="shag-4-1-sub4"><?php echo Yii::t('common', 'ou will pass on website payment system to pay') ?></p>-->

<div>
    <input type="button" name="btn" id="btn_pay" class="btn-style-blue btn-style-blue-4-1" value="<?php echo Yii::t('common', 'PAY $ 50') ?>" />
</div>

<?php $this->renderPartial('pay', array('participant' => $participant, 'tariff' => Participant::TARIFF_50), false, true); ?>