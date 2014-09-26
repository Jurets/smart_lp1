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
    <div><a id="logo" href="#"> </a></div>
    <div id="FORMA">
        
        <p class="zagolovok"><?php echo BaseModule::t('rec', 'ACCOUNT SETTINGS') ?></p>

        <p class="zagolovok2">
            <?php echo BaseModule::t('rec', 'All fields except your profile skype and social networks are required') ?>.<br>
            <?php echo BaseModule::t('rec', 'The selected name of your account will be reserved for you until it is activated') ?>.<br>
            <?php echo BaseModule::t('rec', 'But even up to 30 days after deactivation, yours choosen name will be fixed') ?>.<br>
           </p>
        <a href="#" class="zagolovok3"></a>

        <?php if(Yii::app()->user->hasFlash('settings saved')) { ?>
             <div style="background-color:greenyellow; margin: 211px 0px 0px 420px ">
                  <?php  echo BaseModule::t('common',Yii::app()->user->getFlash('settings saved')) ?>
             </div>
        <?php } ?>   

        <p class="sub1"><?php echo BaseModule::t('rec', 'USERNAME') ?>:</p>
        <?php echo $form->textField($participant, 'username', array('class' => 'textbox1')); //ИМЯ ПОЛЬЗОВАТЕЛЯ ?>
        <?php echo $form->error($participant, 'username', array('class' => 'error-message em-1')); //ИМЯ ПОЛЬЗОВАТЕЛЯ ?>


        <p class="sub2"><?php echo BaseModule::t('rec', 'NAME') ?>*:</p>
        <?php echo $form->textField($participant, 'first_name', array('class' => 'textbox2')); //ИМЯ ?>
        <?php echo $form->error($participant, 'first_name', array('class' => 'error-message em-2')); //ИМЯ ?>


        <p class="sub2-1"><?php echo BaseModule::t('rec', 'SURNAME') ?>*:</p>
        <?php echo $form->textField($participant, 'last_name', array('class' => 'textbox2-1')); //ФАМИЛИЯ ?>
        <?php echo $form->error($participant, 'last_name', array('class' => 'error-message em-3')); //ФАМИЛИЯ ?>

        <?php
        foreach(range(1,31) as $d){
        $arrayDay[$d] =  $d;}

        foreach(range(1,12) as $m){
        $arrayMonth[$m] =  $m;}

        foreach(range(1900,1996) as $y){
            $arrayYear[$y] =  $y;}

        if($day!=='' and $day{0} === "0"){
            $day = $day{1};
        }

        if($day!=='' and $month{0} === "0"){
            $month = $month{1};
        }
        ?>

        <p class="sub3-1"><?php echo BaseModule::t('rec', 'DATE OF BIRTH') ?>*:</p>
        <?php echo Chtml::dropDownList('date_ofb', $day, $arrayDay, array('class' => 'textbox3-1', 'empty'=>'-'))?>
        <?php echo Chtml::dropDownList('month_ofb', $month, $arrayMonth, array('class' => 'textbox3-2', 'empty'=>'-'))?>
        <?php echo Chtml::dropDownList('year_ofb', $year, $arrayYear, array('class' => 'textbox3-3', 'empty'=>'-'))?>
        <?php echo $form->error($participant, 'dob' , array('class' => 'error-message em-4')); //День рождения ?>

<!--        <p class="sub3-1">--><?php //echo BaseModule::t('common', 'DATE OF BIRTH') ?><!--*:</p>-->
<!--        --><?php //echo CHtml::textField('date_ofb',$day, array('class' => 'textbox3-1')); //День рождения ?>
<!--        --><?php //echo CHtml::textField('month_ofb',$month, array('class' => 'textbox3-2')); //Месяц рождения ?>
<!--        --><?php //echo CHtml::textField('year_ofb',$year, array('class' => 'textbox3-3')); //Год рождения ?>
<!--        --><?php //echo $form->error($participant, 'dob' , array('class' => 'error-message em-4')); //День рождения ?>


        <p class="shag-1-1-option1text"> <?php echo BaseModule::t('rec', 'COUNTRY') ?>*:</p>
        <input type="checkbox" name="country_access" id="checkboxG51" value="1" class="css-checkbox1" <?php if($participant->country_access == 1){echo 'checked="checked"';} ?>/>
        <label for="checkboxG51" class="css-label1" style="width: 38px; height: 38px;"></label>

        <a href="#" name="label-1" class="vopros1"></a>

        <select name="countrySelect" class="shag-1-1-option1">
            <?php foreach($places as $key=>$place) {?>
                <?php if($participant->country_id == $key) {?>
                <option value="<?php echo $key; ?>" selected ><?php echo $place; ?></option>
                <?php }else{?>
                <option value="<?php echo $key; ?>" ><?php echo $place; ?></option>
                <?php } ?>
            <?php } ?>
        <?php echo $form->error($participant, 'country' , array('class' => 'error-message em-5')); //Страна ?>



        <input type="checkbox" name="city_access" id="checkboxG52"  value="1" class="css-checkbox2" <?php if($participant->city_access == 1){echo 'checked="checked"';} ?>/>
        <label for="checkboxG52" class="css-label2" style="width: 38px; height: 38px; padding: 0"></label>


        <p class="shag-1-1-option2text"><?php echo BaseModule::t('rec', 'CITY') ?>*: </p>
        <a href="#" name="label-2" class="vopros2"></a>
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



            <p class="shag-1-1-option1-1text"> <?php echo BaseModule::t('rec','SKYPE:')?></p>
            <input type="checkbox" name="skype_access" id="checkboxG53" value="1" class="css-checkbox3"  <?php if($participant->skype_access == 1){echo 'checked="checked"';} ?> />
            <label for="checkboxG53" class="css-label3" style="width: 38px; height: 38px; padding: 0"></label>

<!--       <a href="#" name="label-3" class="vopros1-1" title="разрешить показывать всемпользователям"></a>-->
        <a href="#" name="label-3" class="vopros1-1"></a>
        <?php echo $form->textField($participant, 'skype', array('class' => 'shag-1-1-option1-1')); //skype ?>
        <?php echo $form->error($participant, 'skype', array('class' => 'error-message em-7')); //skype ?>



        <p class="sub1-1"><?php echo BaseModule::t('rec', 'VIBER / MOBILE') ?>*:</p>
        <?php echo $form->textField($participant, 'phone', array('class' => 'textbox1-1')); //VIBER / МОБИЛЬНЫЙ ?>
        <?php echo $form->error($participant, 'phone', array('class' => 'error-message em-8')); //VIBER / МОБИЛЬНЫЙ ?>


        <p class="sub2-3"><?php echo BaseModule::t('rec', 'CURRENT PASSWORD') ?>*:</p>


        <?php echo CHtml::passwordField('currentPassword','', array('class' => 'textbox2-3')); //ТЕКУЩИЙ ПАРОЛЬ ?>
        <?php echo $form->error($participant, 'currentPassword', array('class' => 'error-message em-12')); //ТЕКУЩИЙ ПАРОЛЬ ?>

        <p class="sub2-4"><?php echo BaseModule::t('rec', 'NEW PASSWORD') ?>*:</p>


        <?php echo CHtml::passwordField('newPassword','', array('class' => 'textbox2-4')); //НОВЫЙ ПАРОЛЬ ?>
        <?php echo $form->error($participant, 'newPassword', array('class' => 'error-message em-13')); //НОВЫЙ ПАРОЛЬ ?>



        <p class="sub2-5"><?php echo BaseModule::t('rec', 'NEW PURSE') ?>:</p>
        <?php echo $form->textField($participant, 'newPurse', array('class' => 'textbox2-5')); //НОВЫЙ КОШЕЛЕК ?>
        <?php echo $form->error($participant, 'newPurse', array('class' => 'error-message em-14')); //НОВЫЙ КОШЕЛЕК ?>

        <a href="#" class="pm1"></a>


        <p class="shag-1-1-option2-1text">EMAIL*: </p>
        <input type="checkbox" name="email_access" value="1" id="checkboxG54" class="css-checkbox4" <?php if($participant->email_access == 1){echo 'checked="checked"';} ?>/>
        <label for="checkboxG54" class="css-label4" style="width: 38px; height: 38px; padding: 0"></label>

        <a href="#" name="label-4" class="vopros2-1"></a>
        <?php echo $form->textField($participant, 'email', array('class' => 'shag-1-1-option2-1')); //Email ?>
        <?php echo $form->error($participant, 'email',array('class' => 'error-message em-11')); //Email ?>

        <p class="shag-1-1-option3text"> <?php echo BaseModule::t('rec', 'MY TIME') .'*' ?>:</p>
        <?php
            if(isset($participant->getErrors()['gmt_id']))
            echo '<div class="error-message em-6and5">'. $participant->getErrors()['gmt_id'][0] .'</div>' 
        ?>
            <select name="timeZoneSelect" class="shag-1-1-option3">
                <option value=""></option>
            <?php foreach($gmtZone as $key=>$currentGmt) {?>
                <?php if($participant->gmt_id == $key) {?>
                    <option value="<?php echo $key; ?>" selected ><?php echo $currentGmt; ?></option>
                <?php }else{?>
                    <option value="<?php echo $key; ?>" ><?php echo $currentGmt; ?></option>
                <?php } ?>
            <?php } ?>
        </select>



        <p class="shag-1-1-option3-1text">  <?php echo BaseModule::t('rec', 'LANGUAGE') ?>:</p>
        <select class="shag-1-1-option3-1">


            <option value="volvo"><?php echo BaseModule::t('rec', 'RUSSIAN') ?></option>
            <option value="saab"><?php echo BaseModule::t('rec', 'RUSSIAN2') ?></option>

        </select>

        <p class="shag-1-1-option5text"><?php echo BaseModule::t('common', 'YOUR PURSE') ?></p>


        <p class="dannie"> <?php echo BaseModule::t('rec', 'PAYMENT DETAILS') ?>:</p>
        <?php echo $form->textField($participant, 'purse', array('class' => 'textbox5','readonly'=>true)); //Кошелек ?>
        <?php echo $form->error($participant, 'purse' ,array('class'=>'error-message em-10')); //Кошелек ?>
        <a href="#" class="pm2"></a>



        <p class="shag-1-1-option4text"> <?php echo BaseModule::t('rec', 'AVATAR') ?>:</p>
        <?php if($participant->photo != '') { ?>
            <div id="shag-1-1-photo-db">

        <?php echo CHtml::image(UrlHelper::getImageUrl('resized-'.$participant->photo),'',array('style' => 'width:250px; height: 175px')); ?>
            </div>
        <?php } else{ ?>
            <div id="shag-1-1-avatar"></div>
        <?php } ?>

        <div id="shag-1-1-vibrat"><span id="shag-1-1-vibrat-image"><?php echo BaseModule::t('rec', 'SELECT IMAGE') ?></span>
            <?php echo $form->fileField($participant, 'photo',array('class'=>'shag-fileFiled')); ?>
        </div>
        <?php echo $form->error($participant, 'photo',array('class'=>'error-message em-9')); ?>

        <?php echo CHTML::submitButton(BaseModule::t('rec', 'SAVE'), array('class' => 'btn-style-green', 'name' => 'btn')) ?>


        <?php $this->endWidget(); ?>


        <div id="popup-1"  class="p-6-popup"><span><?php echo BaseModule::t('rec', 'show country to everyone user') ?></span><img class="stick"
                                                                                src="/images/popupstick.png" width="1">
        </div>

        <div id="popup-2"  class="p-6-popup"><span><?php echo BaseModule::t('rec', 'show city to everyone user') ?></span><img class="stick"
                                                                                        src="/images/popupstick.png"
                                                                                        width="1"></div>

        <div id="popup-3"  class="p-6-popup"><span><?php echo BaseModule::t('rec', 'show skype to everyone user') ?></span><img class="stick"
                                                                                           src="/images/popupstick.png"
                                                                                           width="1"></div>
        <div id="popup-4"  class="p-6-popup"><span><?php echo BaseModule::t('rec', 'show email to everyone user') ?></span><img class="stick"
                                                                                        src="/images/popupstick.png"
                                                                                        width="1"></div>

    </div>

    <div><a id="logo" href="/"> </a></div>

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
    div.wrap{
        padding: 0;
    }

    #shag-1-1-vibrat input{
        padding: 0;
        margin: 0;
        position: absolute;
        right: 0;
        top: 0;
        opacity: 0;
        /*font-size:199px !important;*/
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
    /* gmt */
    .em-6and5 {
        top: 854px; left:135px;
    }
    /* skype */
    .em-7{ top: 665px; left:625px; }
    /* phone */
    .em-8{ top: 575px; left:625px; }
    /* photo */
    .em-9{ top: 485px; left:625px; }
    /* purse */
    .em-10{ top: 575px; left:625px; }
    /* email */
    .em-11{ top: 760px; left:625px; }
    /* password */

    .em-12{ top: 855px; left:625px; }
    /* newPassword */

    .em-13{ top: 950px; left:625px; }
    /* newPurse */
    .em-14{ top: 575px; left:625px; }

    select {
       width: 246px;
    }
   
  
   
    
    
    select.textbox3-1, select.textbox3-2{
        width: 60px!important;
    }

    select.textbox3-3{
        width: 120px!important;
    }
    
    #office-6-content {
        
    }

</style>