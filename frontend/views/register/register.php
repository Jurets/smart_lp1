<!--<style type="text/css">
    .btn-style1 {
        width: 249px; 
        height: 41px;
        position: absolute;
        top: 173px;
        background-color: #838383;
        text-align: center;
        padding-top: 6px;
        font-size: 25px;
        text-shadow: 1px 1px 1px #4d4d4d;
        font-weight: bold;
        color: #f2f2f2;
        border: 1px solid #bebebe;
    }

    .error {
        border-color: #FF0000;
        border-width: medium;
    }  
    
    .error-message {
        color: #FF0000;
        font-size: medium;
        font-weight: lighter;
        /*top: 411px;*/
        width: 400px;
        height: 22px;
        position: absolute;
    }  
    
    .em-1 { top: 318px; }  
    .em-2 { top: 411px; }  
    .em-3 { top: 501px; }  
    .em-4 { top: 594px; }  
    .em-5 { top: 680px; }  
    
</style>

<h2 id="shag-1-1-h3" >РЕГИСТРАЦИЯ НОВОГО УЧАСТНИКА СИСТЕМЫ</h2>
<div id="topShagLine"></div>
<div  class="btn-style1"> ШАГ 1</div>
<div class="btn-style2"> ШАГ 2</div>
<div class="btn-style3"> ШАГ 3</div>
<div class="btn-style4"> ШАГ 4</div>-->

<?php //$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
    //'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
));
?>

<p class="sub1">ИМЯ ПОЛЬЗОВАТЕЛЯ:</p>
<?php echo $form->textField($participant, 'username', array('class'=>'textbox1')); //логин ?>
<?php echo $form->error($participant, 'username', array('class'=>'error-message em-1')); //логин ?>

<p class="sub2">E-MAIL:</p>
<?php echo $form->textField($participant, 'email', array('class'=>'textbox2')); //email ?>
<?php echo $form->error($participant, 'email', array('class'=>'error-message em-2')); //логин ?>

<p class="shag-1-1-option2text">СТРАНА: </p>
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


<p class="shag-1-1-option1text">  ГОРОД:</p>
<?php echo $form->dropDownList($participant, 'city_id', Cities::getCitiesListByCountry($participant->country_id), array(
    'id'=>'Participant_city_id',
    'class'=>'shag-1-1-option1',
    'displaySize'=>'1',
    'prompt'=>ViewHelper::getPrompt('select city'),
)); ?>
<?php echo $form->error($participant, 'city_id', array('class'=>'error-message em-4')); //логин ?>

<p class="shag-1-1-option3text">  ЯЗЫК:</p>
<select class="shag-1-1-option3">
    <option value="volvo">РУССКИЙ</option>
    <option value="saab">РУССКИЙ2</option>
</select>                          

<p class="shag-1-1-option4text">  АВАТАР:</p>

<div id="shag-1-1-avatar"></div>
<a href="#"><span id="shag-1-1-vibrat">ВЫБРАТЬ ИЗОБРАЖЕНИЕ</span></a> 

<p class="sub3">
    Я согласен с правилами и принимаю 
    <?php 
   /* echo TbHtml::linkButton('пользовательское соглашение', array(
//'style' => TbHtml::BUTTON_COLOR_PRIMARY,
//'size' => TbHtml::BUTTON_SIZE_LARGE,
//'data-toggle' => 'modal',
//'data-target' => '#sogloshenie',
    'onclick'=>'js:$("sogloshenie").show',
));*/ ?>
    <a id="open-btn" href="#">пользовательское соглашение</a>
</p>
<?php echo $form->checkBox($participant, 'rulesAgree', array('class'=>'css-checkbox', 'readonly'=>true)); //согласие с ПользСоглашением ?>
<!--<input type="checkbox" name="checkboxG5" id="checkboxG5" class="css-checkbox" checked="checked"/>-->
<!--<input type="checkbox" name="checkboxG5" id="checkboxG5" class="css-checkbox" checked="checked"/>-->
<!--<label for="checkboxG5" class="css-label"></label>-->
<label for="Participant_rulesAgree" class="css-label"></label>
<?php echo $form->error($participant, 'rulesAgree', array('class'=>'error-message em-5')); //логин ?>

<!--<a href="shag-1-3.html"><input type="button" name="btn"  class="btn-style-green" value="ДАЛЕЕ" /></a>-->
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
    <a id="logo" href="index.html"> </a>
</div>
   
   
<div id='sogloshenie' style="display: none;">
    <p id='shag-1-2-textArea' > 
        <span>Ползовательское соглашение</span><br><br>

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