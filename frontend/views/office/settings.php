<?php
/**
 * $this OfficeController
 */
Yii::app()->clientScript->registerCssFile('/css/style-office.css');
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'settings-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    //'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
));
?>
<div id="office-6-content">
    <div><a id="logo" href="index.html"> </a></div>
    <div id="FORMA">
        <p class="zagolovok">НАСТРОЙКА АККАУНТА</p>

        <p class="zagolovok2">Все поля твоего профайла кроме skype и соцсети обязательны для заполнения.<br>Выбранное
            имя твоего аккаунта, будет закреплено за тобой, пока он активирован.<br> Но даже до 30 дней после
            деактивации, за тобой будет закреплено выбранное имя.</p>
        <a href="#" class="zagolovok3"></a>


        <p class="sub1">ИМЯ ПОЛЬЗОВАТЕЛЯ:</p>
        <?php echo $form->textField($participant, 'username', array('class' => 'textbox1')); //ИМЯ ПОЛЬЗОВАТЕЛЯ ?>
        <?php echo $form->error($participant, 'username', array('class' => 'error-message em-1')); //ИМЯ ПОЛЬЗОВАТЕЛЯ ?>

        <p class="sub2">ИМЯ*:</p>
        <?php echo $form->textField($participant, 'first_name', array('class' => 'textbox2')); //ИМЯ ?>
        <?php echo $form->error($participant, 'first_name', array('class' => 'error-message em-2')); //ИМЯ ?>

        <p class="sub2-1">ФАМИЛИЯ*:</p>
        <?php echo $form->textField($participant, 'last_name', array('class' => 'textbox2-1')); //ФАМИЛИЯ ?>
        <?php echo $form->error($participant, 'last_name', array('class' => 'error-message em-3')); //ФАМИЛИЯ ?>



        <p class="sub3-1">ДАТА РОЖДЕНИЯ*:</p>
        <input class="textbox3-1" type="text">
        <input class="textbox3-2" type="text">
        <input class="textbox3-3" type="text">


        <p class="shag-1-1-option1text"> СТРАНА*:</p>
        <input type="checkbox" name="city_access" id="city_access" class="css-checkbox1" checked="checked"/>
        <label for="city_access" class="css-label1"></label>
        <a href="#" name="label-1" class="vopros1" title="разрешить показывать всем пользователям"></a>
        <select class="shag-1-1-option1">
            <option value="none" disabled selected>Выберите страну</option>
        </select>


        <input type="checkbox" name="country_access" id="country_access" class="css-checkbox2" checked="checked"/>
        <label for="country_access" class="css-label2"></label>

        <p class="shag-1-1-option2text">ГОРОД*: </p>
        <a href="#" name="label-2" class="vopros2" title="разрешить показывать всем пользователям"></a>
        <select class="shag-1-1-option2"> </select>


        <p class="shag-1-1-option1-1text"> SKYPE:</p>
        <input type="checkbox" name="skype_access" id="skype_access" class="css-checkbox3" checked="checked"/>
        <label for="skype_access" class="css-label3"></label>
        <a href="#" name="label-3" class="vopros1-1" title="разрешить показывать всем пользователям"></a>
        <?php echo $form->textField($participant, 'skype', array('class' => 'shag-1-1-option1-1')); //skype ?>
        <?php echo $form->error($participant, 'skype', array('class' => 'error-message em-0')); //skype ?>


        <p class="sub1-1">VIBER / МОБИЛЬНЫЙ*:</p>
        <?php echo $form->textField($participant, 'phone', array('class' => 'textbox1-1')); //VIBER / МОБИЛЬНЫЙ ?>
        <?php echo $form->error($participant, 'phone', array('class' => 'error-message em-0')); //VIBER / МОБИЛЬНЫЙ ?>
        <p class="sub2-3">ТЕКУЩИЙ ПАРОЛЬ*:</p>
        <?php echo $form->textField($participant, 'password', array('class' => 'textbox2-3')); //ТЕКУЩИЙ ПАРОЛЬ ?>
        <?php echo $form->error($participant, 'password', array('class' => 'error-message em-0')); //ТЕКУЩИЙ ПАРОЛЬ ?>
        <p class="sub2-4">НОВЫЙ ПАРОЛЬ*:</p>
        <input class="textbox2-4" type="password">

        <p class="sub2-5">НОВЫЙ КОШЕЛЕК:</p>
        <input class="textbox2-5" type="text">
        <a href="#" class="pm1"></a>


        <p class="shag-1-1-option2-1text">EMAIL*: </p>
        <input type="checkbox" name="email_access" id="email_access" class="css-checkbox4" checked="checked"/>
        <label for="email_access" class="css-label4"></label>
        <a href="#" name="label-4" class="vopros2-1" title="разрешить показывать всем пользователям"></a>
        <input class="shag-1-1-option2-1" type="text" value="">


        <p class="shag-1-1-option3text"> МОЕ ВРЕМЯ:</p>
        <select class="shag-1-1-option3">
            <option value="none" disabled selected>Выберите часовой пояс</option>
        </select>


        <p class="shag-1-1-option3-1text"> ЯЗЫК:</p>
        <select class="shag-1-1-option3-1">
            <option value="volvo">РУССКИЙ</option>
            <option value="saab">РУССКИЙ2</option>

        </select>

        <p class="shag-1-1-option5text"> ВАШ КОШЕЛЕК</p>

        <p class="dannie"> ПЛАТЕЖНЫЕ ДАННЫЕ:</p>
        <input class="textbox5" type="text">
        <a href="#" class="pm2"></a>


        <p class="shag-1-1-option4text"> АВАТАР:</p>


        <div id="shag-1-1-avatar"></div>
        <div id="shag-1-1-vibrat"><span id="shag-1-1-vibrat-image">ВЫБРАТЬ ИЗОБРАЖЕНИЕ</span>
            <?php echo $form->fileField($participant, 'photo',array('class'=>'shag-fileFiled')); ?>
        </div>
        <?php echo $form->error($participant, 'photo'); ?>
        <?php echo CHTML::submitButton('СОХРАНИТЬ', array('class' => 'btn-style-green', 'name' => 'btn')) ?>


        <?php $this->endWidget(); ?>

        <div id="popup-1"  class="p-6-popup"><span>wddwdw fd fd df df</span><img class="stick"
                                                                                src="images/popupstick.png" width="13">
        </div>
        <div id="popup-2"  class="p-6-popup"><span>wddwdw gfgfgfd ffgfd df df</span><img class="stick"
                                                                                        src="images/popupstick.png"
                                                                                        width="13"></div>
        <div id="popup-3"  class="p-6-popup"><span>wddwdw fd fdfgffg df dfgfgfgf</span><img class="stick"
                                                                                           src="images/popupstick.png"
                                                                                           width="13"></div>
        <div id="popup-4"  class="p-6-popup"><span>wddwdw ffgfgd fgfgfd df df</span><img class="stick"
                                                                                        src="images/popupstick.png"
                                                                                        width="13"></div>

    </div>

    <div><a id="logo" href="index.html"> </a></div>

</div>


</div>
<div class="wrap"></div>

</div>
<script>
    $.getJSON('place', function (data) {
        $.each(data, function (key, val) {
            $('.shag-1-1-option1').append("<option value='" + key + "'>" + val + "</option>");
        });
    });
    $('.shag-1-1-option2').prop('disabled', true);
    $('.shag-1-1-option1').change(function () {
        if ($(this).val() !== 'none') {
            $.getJSON('city', {
                countryId: $('.shag-1-1-option1').val()
            }).done(function (data) {
                $('.shag-1-1-option2').empty();
                $.each(data, function (key, val) {
                    $('.shag-1-1-option2').append("<option value='" + key + "'>" + val + "</option>");
                });
                $('.shag-1-1-option2').prop('disabled', false);
            });
        }
    });
    $.getJSON('timezone', function (data) {
        $.each(data, function (key, val) {
            $('.shag-1-1-option3').append("<option value='" + key + "'>" + val + "</option>");
        });
    });

    $('[id^="popup"]').hide();
    $('[name^="label"]').hover(function () {
        $('[id="popup-' + $(this).attr('name')[6] + '"]').show();
    }, function () {
        $('[id="popup-' + $(this).attr('name')[6] + '"]').hide();
    });


    $('.shag-fileFiled').change(function() {
        var fileName = $(this).val();
        if(fileName.length > 30) {
            fileName = fileName.substr(0, 29) + '...';
        }
        $('#shag-1-1-vibrat-image').html(fileName);
    });


</script>

<style>
    #shag-1-1-vibrat input{
        padding: 0;
        margin: 0;
        position: absolute;
        right: 0;
        top: 0;
        opacity: 0;
        font-size:199px !important;
        cursor:pointer;
        border:none;
    }
</style>