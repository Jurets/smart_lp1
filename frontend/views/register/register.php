<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

<p class="sub1"><?php echo Yii::t('common', 'USERNAME') ?>:</p>
<?php echo $form->textField($participant, 'username', array('class'=>'textbox1')); //логин ?>
<?php echo $form->error($participant, 'username', array('class'=>'error-message em-1')); //логин ?>

<p class="sub2">E-MAIL:</p>
<?php echo $form->textField($participant, 'email', array('class'=>'textbox2')); //email ?>
<?php echo $form->error($participant, 'email', array('class'=>'error-message em-2')); //логин ?>

<p class="shag-1-1-option2text"><?php echo Yii::t('common', 'COUNTRY') ?>: </p>
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


<p class="shag-1-1-option1text">  <?php echo Yii::t('common', 'CITY') ?>:</p>
<?php echo $form->dropDownList($participant, 'city_id', Cities::getCitiesListByCountry($participant->country_id), array(
    'id'=>'Participant_city_id',
    'class'=>'shag-1-1-option1',
    'displaySize'=>'1',
    'prompt'=>ViewHelper::getPrompt('select city'),
)); ?>
<?php echo $form->error($participant, 'city_id', array('class'=>'error-message em-4')); //логин ?>

<p class="shag-1-1-option3text">  <?php echo Yii::t('common', 'LANGUAGE') ?>:</p>
<select class="shag-1-1-option3">
    <option value="volvo"><?php echo Yii::t('common', 'RUSSIAN') ?></option>
    <option value="saab"><?php echo Yii::t('common', 'RUSSIAN2') ?></option>
</select>                          

<p class="shag-1-1-option4text">  <?php echo Yii::t('common', 'AVATAR') ?>:</p>

<div id="shag-1-1-avatar"></div>
<a href="#"><span id="shag-1-1-vibrat"><?php echo Yii::t('common', 'SELECT IMAGE') ?></span></a> 

<p class="sub3">
    <?php echo Yii::t('common', 'I agree with the rules and accept') ?>
    <?php 
   /* echo TbHtml::linkButton('пользовательское соглашение', array(
//'style' => TbHtml::BUTTON_COLOR_PRIMARY,
//'size' => TbHtml::BUTTON_SIZE_LARGE,
//'data-toggle' => 'modal',
//'data-target' => '#sogloshenie',
    'onclick'=>'js:$("sogloshenie").show',
));*/ ?>
    <a id="open-btn" href="#"><?php echo Yii::t('common', 'Terms and conditions') ?></a>
</p>
<?php echo $form->checkBox($participant, 'rulesAgree', array('class'=>'css-checkbox', 'readonly'=>true)); //согласие с ПользСоглашением ?>
<label for="Participant_rulesAgree" class="css-label"></label>
<?php echo $form->error($participant, 'rulesAgree', array('class'=>'error-message em-5')); //логин ?>

<?php echo CHtml::submitButton(Yii::t('common', 'Next'), array('class'=>'btn-style-green')); ?>

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
    <p id='shag-1-2-textArea' > 
        <span><?php echo Yii::t('common', 'Terms and conditions') ?></span><br><br>

        Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для  текстов на латинице с начала XVI века. В то время некий
        безымянный печатник со<br>здал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изм<br>енений пять

        веков, но и переша<br>гнул в электронный дизайн.<br> Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus
        PageMaker, в шаблонах котор<br>ых используется Lorem Ipsum.

        Lorem Ipsum - это текст-"рыба", <br>часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий
        безымянный печатник создал большую коллекцию
        размеров и форм шрифтов, и<br>спользуя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без<br> заметных
        изменений пять веков, но и перешагн<br>ул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х
        годах и, в более н<br>едавнее время, программы электронной
        вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum. Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem
        Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий
        безымянный печатник создал бо<br>льшу<br>ю коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.
        Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.
    </p>
    <a href="#">
        <img id="close-btn" src="images/Х.png" width="22">
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
</script>