<style>
    div#shag-1-1-vibrat{
        overflow: hidden;
    }

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
        top:368px;
        left: 422px;
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
    /* photo */
    .em-9{ top: 590px; left:422px; }

    div#topLine{
        height: 39px;
    }

    a#logo{
        left: 0;
    }
    
    form#login {
        left: 769px;
    }
   
   #sub1-login {
       top: 15px;
   }
   
   /*#UserLogin_username {
       margin-top: 5px;
       top: 50px !important;
   }*/
   
   #fake-button {
       top: 112px;
   }
   
</style>

<?php 
    Yii::app()->getClientScript()->registerScriptFile("/js/main.js");

    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'register-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
    ));
?>

<p class="sub1"><?php echo BaseModule::t('common', 'USERNAME') ?>:</p>
<?php echo $form->textField($participant, 'username', array('class'=>'textbox1', 'style'=>'text-transform: lowercase;')); //логин ?>
<?php echo $form->error($participant, 'username', array('class'=>'error-message em-1')); //логин ?>

<p class="sub2">E-MAIL:</p>
<?php echo $form->textField($participant, 'email', array('class'=>'textbox2')); //email ?>
<?php echo $form->error($participant, 'email', array('class'=>'error-message em-2')); //логин ?>

<p class="shag-1-1-option2text"><?php echo BaseModule::t('common', 'COUNTRY') ?>: </p>
<?php echo $form->dropDownList($participant, 'country_id', Countries::getCountriesList(), array(
        'id'=>'Participant_country_id',
        'class'=>'shag-1-1-option2',
        'displaySize'=>'1',
        'prompt'=>ViewHelper::getPrompt('select country'),
        'ajax' => array(
            'type'=>'POST', //request type
            'url'=>CController::createUrl('dynamiccities'), //url to call.
            'data'=>array('country_id'=>'js:this.value'),
            'update'=>'#Participant_city_id',
        ),
    )); ?>
<?php echo $form->error($participant, 'country_id', array('class'=>'error-message em-3')); //логин ?>


<p class="shag-1-1-option1text">  <?php echo BaseModule::t('common', 'CITY') ?>:</p>
<?php echo $form->dropDownList($participant, 'city_id', Cities::getCitiesListByCountry($participant->country_id), array(
        'id'=>'Participant_city_id',
        'class'=>'shag-1-1-option1',
        'displaySize'=>'1',
        'prompt'=>ViewHelper::getPrompt('select city'),
    )); ?>
<?php echo $form->error($participant, 'city_id', array('class'=>'error-message em-4')); //логин ?>

<p class="shag-1-1-option3text">  <?php echo BaseModule::t('common', 'LANGUAGE') ?>:</p>
<select class="shag-1-1-option3" name="language">
    <?php foreach ($languages as $language) { ?>
        <option value="<?php echo $language['lang']?>"> <?php echo BaseModule::t('rec', $language['name']) ?></option>
    <?php }?>
</select>

<p class="shag-1-1-option4text">  <?php echo BaseModule::t('common', 'AVATAR') ?>:</p>


<?php if($participant->photo != '') { ?>
    <div id="shag-1-1-photo-db">
        <?php echo CHtml::image(UrlHelper::getImageUrl('resized-'.$participant->photo),'',array('style' => 'width:250px; height: 175px')); ?>
    </div>
<?php } else { ?>
    <div id="shag-1-1-avatar"><img id="thumbnil" style="width:100%; height: 100%; border: none;"  src="" alt=""/></div>
<?php } ?>
<div id="shag-1-1-vibrat"><span id="shag-1-1-vibrat-image"><?php echo BaseModule::t('common', 'SELECT IMAGE') ?></span>
    <?php echo $form->fileField($participant, 'photo',array('class'=>'shag-fileFiled')); ?>
</div>
<?php echo $form->error($participant, 'photo',array('class'=>'error-message em-9')); ?>

<p class="sub3">
    <?php echo BaseModule::t('rec', 'I agree with the rules and accept') ?>
    <a id="open-btn" href="#"><?php echo BaseModule::t('rec', 'Terms and conditions') ?></a>
</p>

<?php echo $form->checkBox($participant, 'rulesAgree', array('class'=>'css-checkbox', 'readonly'=>true)); //согласие с ПользСоглашением ?>
<label for="Participant_rulesAgree" class="css-label"></label>
<?php echo $form->error($participant, 'rulesAgree', array('class'=>'error-message em-5')); //логин ?>

<?php echo CHtml::submitButton(BaseModule::t('rec', 'Next'), array('class'=>'btn-style-green')); ?>

<?php $this->endWidget(); ?>

<div>
    <a id="logo" href="<?php echo Yii::app()->createAbsoluteUrl(''); ?>"> </a>
</div>


<div id='sogloshenie' style="display: none;">
    <div id='shag-1-2-textArea' >
        <span><?php echo BaseModule::t('rec', 'Terms and conditions') ?></span><br><br>
        <?php echo($details)?>
    </div>
    <a href="#">
        <img id="close-btn" src="/images/Х.png" width="22">
    </a>
</div>

<script>
    $(document).ready(function() {
        $('#open-btn').click(function(){
            $('#sogloshenie').show(); 
            return false;
        });
        $('#close-btn').click(function(){
            $('#sogloshenie').hide(); 
            return false;
        });
        
        $("#Participant_username").keypress(function(event) {
            var key = (typeof event.charCode == 'undefined' ? event.keyCode : event.charCode); 
            // Ignore special keys
            if (event.ctrlKey || event.altKey || key < 32)
                return true;
            key = String.fromCharCode(key);
            // test for alpha-numeric
            return /\w/.test(key);
        });        
    });

    $('.shag-fileFiled').change(function() {
        showMyImage(this);
    });

    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img=document.getElementById("thumbnil");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            var fileName = file.name;
            if(fileName.length > 30) {
                fileName = fileName.substr(0, 29) + '...';
            }
            $('#shag-1-1-vibrat-image').html(fileName);
            reader.readAsDataURL(file);
        }
    }
</script>
