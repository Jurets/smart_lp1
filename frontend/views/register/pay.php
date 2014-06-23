<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'pay-form',
    'enableAjaxValidation'=>false,
)); ?>
    <?php echo CHtml::activeHiddenField($participant, 'postedActivKey'); ?>
    <?php echo CHtml::activeHiddenField($participant, 'tariff_id', array('value'=>$tariff)); ?>
    
    <a href="">
        <?php echo CHtml::submitButton(Yii::t('common', 'Next'), array(
            'name'=>'pay',
            'class'=>($participant->tariff_id >= $tariff ? 'btn-style-green btn-style-green-2-1' : 'btn-style-gray'),
            'style'=>'cursor: pointer;',
            'readonly'=>($participant->tariff_id < $tariff),
            'id'=>'btn_next',
        )); ?>
    </a>

<?php $this->endWidget(); ?>

<div><a id="logo" href="index.html"> </a></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btn_pay').click(function(){
            alert('ЭТО ТЕСТОВЫЙ РЕЖИМ! Оплата произведена успешно!');
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