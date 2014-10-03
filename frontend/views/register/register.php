<style type="text/css">
    /*.textbox1 {*/
        /*border: 1px solid #d8d8d8;*/
        /*border-radius: 1px;*/
        /*display: block;*/
        /*height: 38px !important;*/
        /*left: 1px;*/
        /*position: absolute;*/
        /*top: 277px;*/
        /*width: 251px;*/
    /*}*/
    /*.textbox2 {*/
        /*border: 1px solid #d8d8d8;*/
        /*border-radius: 1px;*/
        /*display: block;*/
        /*height: 38px !important;*/
        /*left: 1px;*/
        /*position: absolute;*/
        /*top: 370px;*/
        /*width: 251px;*/
    /*}*/
</style>

<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

<p class="sub1"><?php echo BaseModule::t('common', 'USERNAME') ?>:</p>
<?php echo $form->textField($participant, 'username', array('class'=>'textbox1')); //логин ?>
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
<!--<select class="shag-1-1-option3">
    <option value="volvo"><?php // echo BaseModule::t('common', 'RUSSIAN') ?></option>
    <option value="saab"><?php // echo BaseModule::t('common', 'RUSSIAN2') ?></option>
</select> 
-->
   <select class="shag-1-1-option3" name="language">
 <?php foreach ($languages as $language) { ?>
         <option value="<?php echo $language['lang']?>"> <?php echo BaseModule::t('rec', $language['name']) ?></option>
 <?php }?>
   </select>

<p class="shag-1-1-option4text">  <?php echo BaseModule::t('common', 'AVATAR') ?>:</p>


<!--<div id="shag-1-1-avatar"></div>-->
<!--<a href="#"><span id="shag-1-1-vibrat">--><?php //echo BaseModule::t('common', 'SELECT IMAGE') ?><!--</span></a>-->


<?php //$this->widget('common.extensions.FileUpload.widgets.UploadFileWidget.UploadFileWidget',
//    array('participant'=>$participant, 'params'=>array('width'=>377, 'height'=>191),
//        're_org'=>array('width'=>554, 'height'=>281),
//    )); ?>

<?php if($participant->photo != '') { ?>
    <div id="shag-1-1-photo-db">
        <?php echo CHtml::image(UrlHelper::getImageUrl('resized-'.$participant->photo),'',array('style' => 'width:250px; height: 175px')); ?>
    </div>
<?php } else{ ?>
    <div id="shag-1-1-avatar"></div>
<?php } ?>
<div id="shag-1-1-vibrat"><span id="shag-1-1-vibrat-image"><?php echo BaseModule::t('common', 'SELECT IMAGE') ?></span>
    <?php echo $form->fileField($participant, 'photo',array('class'=>'shag-fileFiled')); ?>
    <?php //echo CHtml::fileField('photo[]','',array('class'=>'shag-fileFiled')); ?>
</div>
<?php echo $form->error($participant, 'photo',array('class'=>'error-message em-9')); ?>
<?php //echo CHtml::error($participant, 'photo',array('class'=>'error-message em-9')); ?>



<p class="sub3">
    <?php echo BaseModule::t('rec', 'I agree with the rules and accept') ?>
    <?php 
   /* echo TbHtml::linkButton('пользовательское соглашение', array(
//'style' => TbHtml::BUTTON_COLOR_PRIMARY,
//'size' => TbHtml::BUTTON_SIZE_LARGE,
//'data-toggle' => 'modal',
//'data-target' => '#sogloshenie',
    'onclick'=>'js:$("sogloshenie").show',
));*/ ?>
    <a id="open-btn" href="#"><?php echo BaseModule::t('rec', 'Terms and conditions') ?></a>
</p>
<?php echo $form->checkBox($participant, 'rulesAgree', array('class'=>'css-checkbox', 'readonly'=>true)); //согласие с ПользСоглашением ?>
<label for="Participant_rulesAgree" class="css-label"></label>
<?php echo $form->error($participant, 'rulesAgree', array('class'=>'error-message em-5')); //логин ?>

<?php echo CHtml::submitButton(BaseModule::t('rec', 'Next'), array('class'=>'btn-style-green')); ?>

<?php $this->endWidget(); ?>

<?php
/*$this->widget('bootstrap.widgets.TbModal', array(
'id' => 'myModal',
'header' => 'Modal Heading',
'content' => '<p>One fine body...</p>',
'footer' => array(
TbHtml::button('Save Changes', array('data-dismiss' => 'modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
TbHtml::button('Close', array('data-dismiss' => 'modal')),
),
));*/?>

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

    div.footer div#footer-bark-bg{
        display: none;
    }
</style>