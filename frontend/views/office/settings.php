<?php
/**
 * $this OfficeController
 * @var $places
 * @var $citesByCountryId
 * @var $gmtZone
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
        <?php echo CHtml::textField('date_ofb',$day, array('class' => 'textbox3-1')); //День рождения ?>
        <?php echo CHtml::textField('month_ofb',$month, array('class' => 'textbox3-2')); //Месяц рождения ?>
        <?php echo CHtml::textField('year_ofb',$year, array('class' => 'textbox3-3')); //Год рождения ?>
        <?php echo $form->error($participant, 'dob' , array('class' => 'error-message em-4')); //День рождения ?>

        <p class="shag-1-1-option1text"> СТРАНА*:</p>
        <input type="checkbox" name="country_access" id="checkboxG51" value="1" class="css-checkbox1" checked="checked"/>
        <label for="checkboxG51" class="css-label1"></label>
        <a href="#" name="label-1" class="vopros1" title="разрешить показывать всем пользователям"></a>

        <select name="countrySelect" class="shag-1-1-option1">
            <?php foreach($places as $key=>$place) {?>
                <?php if($participant->country_id == $key) {?>
                <option value="<?php echo $key; ?>" selected ><?php echo $place; ?></option>
                <?php }else{?>
                <option value="<?php echo $key; ?>" ><?php echo $place; ?></option>
                <?php } ?>
            <?php } ?>
        <?php echo $form->error($participant, 'country' , array('class' => 'error-message em-5')); //Страна ?>


        <input type="checkbox" name="city_access" id="checkboxG52"  value="1" class="css-checkbox2" checked="checked"/>
        <label for="checkboxG52" class="css-label2"></label>
        <p class="shag-1-1-option2text">ГОРОД*: </p>
        <a href="#" name="label-2" class="vopros2" title="разрешить показывать всем пользователям"></a>
        <select name="citySelect" class="shag-1-1-option2">
            <?php foreach($citesByCountryId as $key=>$city) {?>
                <?php if($participant->city_id == $key) {?>
                    <option value="<?php echo $key; ?>" selected ><?php echo $city; ?></option>
                <?php }else{?>
                    <option value="<?php echo $key; ?>" ><?php echo $city; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
        <?php echo $form->error($participant, 'city' , array('class' => 'error-message em-6')); //Город ?>



            <p class="shag-1-1-option1-1text"> SKYPE:</p>
            <input type="checkbox" name="skype_access" id="checkboxG53" value="1" class="css-checkbox3" checked="checked"/>
            <label for="checkboxG53" class="css-label3"></label>

        <a href="#" name="label-3" class="vopros1-1" title="разрешить показывать всем пользователям"></a>
        <?php echo $form->textField($participant, 'skype', array('class' => 'shag-1-1-option1-1')); //skype ?>
        <?php echo $form->error($participant, 'skype', array('class' => 'error-message em-7')); //skype ?>


        <p class="sub1-1">VIBER / МОБИЛЬНЫЙ*:</p>
        <?php echo $form->textField($participant, 'phone', array('class' => 'textbox1-1')); //VIBER / МОБИЛЬНЫЙ ?>
        <?php echo $form->error($participant, 'phone', array('class' => 'error-message em-8')); //VIBER / МОБИЛЬНЫЙ ?>

        <p class="sub2-3">ТЕКУЩИЙ ПАРОЛЬ*:</p>
        <?php echo CHtml::textField('password','', array('class' => 'textbox2-3','type'=>'password')); //ТЕКУЩИЙ ПАРОЛЬ ?>
        <?php echo $form->error($participant, 'password', array('class' => 'error-message em-12')); //ТЕКУЩИЙ ПАРОЛЬ ?>
        <p class="sub2-4">НОВЫЙ ПАРОЛЬ*:</p>
        <?php echo CHtml::textField('newPassword','', array('class' => 'textbox2-4','type'=>'password')); //НОВЫЙ ПАРОЛЬ ?>
        <?php echo $form->error($participant, 'password', array('class' => 'error-message em-13')); //НОВЫЙ ПАРОЛЬ ?>


        <p class="sub2-5">НОВЫЙ КОШЕЛЕК:</p>
        <input class="textbox2-5" type="text">
        <a href="#" class="pm1"></a>


        <p class="shag-1-1-option2-1text">EMAIL*: </p>
            <input type="checkbox" name="email_access" value="1" id="checkboxG54" class="css-checkbox4" checked="checked"/>
            <label for="checkboxG54" class="css-label4"></label>
        <a href="#" name="label-4" class="vopros2-1" title="разрешить показывать всем пользователям"></a>
        <?php echo $form->textField($participant, 'email', array('class' => 'shag-1-1-option2-1')); //Email ?>
        <?php echo $form->error($participant, 'email',array('class' => 'error-message em-11')); //Email ?>


        <p class="shag-1-1-option3text"> МОЕ ВРЕМЯ:</p>
            <select name="timeZoneSelect" class="shag-1-1-option3">
            <?php foreach($gmtZone as $key=>$currentGmt) {?>
                <?php if($participant->gmt_id == $key) {?>
                    <option value="<?php echo $key; ?>" selected ><?php echo $currentGmt; ?></option>
                <?php }else{?>
                    <option value="<?php echo $key; ?>" ><?php echo $currentGmt; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
<!--        --><?php //echo $form->error($participant, 'gmt', array('class' => 'error-message em-11')); //gmt ?>


        <p class="shag-1-1-option3-1text"> ЯЗЫК:</p>
        <select class="shag-1-1-option3-1">
            <option value="volvo">РУССКИЙ</option>
            <option value="saab">РУССКИЙ2</option>

        </select>

        <p class="shag-1-1-option5text"> ВАШ КОШЕЛЕК</p>

        <p class="dannie"> ПЛАТЕЖНЫЕ ДАННЫЕ:</p>
        <?php echo $form->textField($participant, 'purse', array('class' => 'textbox5')); //Кошелек ?>
        <?php echo $form->error($participant, 'purse' ,array('class'=>'error-message em-10')); //Кошелек ?>
        <a href="#" class="pm2"></a>


        <p class="shag-1-1-option4text"> АВАТАР:</p>
        <?php if($participant->photo != '') { ?>
            <div id="shag-1-1-photo-db">
        <?php echo CHtml::image(UrlHelper::getImageUrl($participant->photo),'',array('style' => 'width:250px; height: 190px')); ?>
            </div>
        <?php } else{ ?>
            <div id="shag-1-1-avatar"></div>
        <?php } ?>
        <div id="shag-1-1-vibrat"><span id="shag-1-1-vibrat-image">ВЫБРАТЬ ИЗОБРАЖЕНИЕ</span>
            <?php echo $form->fileField($participant, 'photo',array('class'=>'shag-fileFiled')); ?>
        </div>
        <?php echo $form->error($participant, 'photo',array('class'=>'error-message em-9')); ?>
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
    #shag-1-1-photo-db{
        position: absolute;
        height:250px !important;
        width: 250px;
        top:275px;
        left: 619px;
    }
    .error {
        border-color: #FF0000;
        border-width: medium;
    }
    .error-message {
        color: #FF0000;
        font-size: medium;
        font-weight: lighter;
        width: 400px;
        height: 22px;
        position: absolute;
    }
    /* username */
    .em-1{ top: 305px; left:135px; }
    /* name */
    .em-2{ top: 395px; left:135px; }
    /* last name */
    .em-3{ top: 485px; left:135px; }
    /* date of birth */
    .em-4{ top: 575px; left:135px; }
    /* country */
    .em-5{ top: 655px; left:135px; }
    /* city */
    .em-6{ top: 750px; left:135px; }
    /* skype */
    .em-7{ top: 665px; left:625px; }
    /* phone */
    .em-8{ top: 575px; left:625px; }
    /* photo */
    .em-9{ top: 485px; left:625px; }
    /* purse */
    .em-10{ top: 575px; left:625px; }
    /* email */
    .em-11{ top: 730px; left:625px; }
    /* password */
    .em-12{ top: 830px; left:625px; }
    /* newPassword */
    .em-13{ top: 925px; left:625px; }



</style>