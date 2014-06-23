<p id="shag-3-1-text" > Для активации аккаунта необходимо внести взнос участника в размере 20$</p>
<p class="shag-3-1-sub4">Вы перейдете на сайт платежной системы для оплаты</p>

<div>
    <input type="button" name="btn" id="btn_pay" class="btn-style-blue btn-style-blue-3-1" value="ОПЛАТИТЬ 20$" />
</div>

<?php $this->renderPartial('pay', array('participant'=>$participant, 'tariff'=>Participant::TARIFF_20), false, true); ?>