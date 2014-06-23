<p id="shag-4-1-text" > Поздравляем! Вы уже зарегистрированы в Системе! <br><br> Теперь чтобы стать бизнес участником, необходимо пройти последний шаг. <br> Бизнес участие позволит вам получать столько то и столько то! Не теряйте время! </p>
<p class="shag-4-1-sub4">Вы перейдете на сайт платежной системы для оплаты</p>

<div>
    <input type="button" name="btn" id="btn_pay" class="btn-style-blue btn-style-blue-4-1" value="ОПЛАТИТЬ 50$" />
</div>

<?php $this->renderPartial('pay', array('participant'=>$participant, 'tariff'=>Participant::TARIFF_50), false, true); ?>