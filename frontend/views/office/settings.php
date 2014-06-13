<?php
/**
 * $this OfficeController
 */
Yii::app()->clientScript->registerCssFile('/css/style-office.css');
//Yii::app()->clientScript->registerScriptFile('/js/jquery-ui.min.js');
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'settings-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
    //'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
));
?>
<div id="office-6-content">
    <div><a  id="logo" href="index.html"> </a></div>
    <div id="FORMA">
             <p class="zagolovok">НАСТРОЙКА АККАУНТА</p>
             <p class="zagolovok2">Все поля твоего профайла кроме skype и соцсети обязательны для заполнения.<br>Выбранное имя твоего аккаунта, будет закреплено за тобой, пока он активирован.<br> Но даже до 30 дней после деактивации, за тобой будет закреплено выбранное имя.</p>
              <a href="#"  class="zagolovok3"></a>




        <p class="sub1">ИМЯ ПОЛЬЗОВАТЕЛЯ:</p>
        <?php echo $form->textField($participant, 'username', array('class'=>'textbox1')); //ИМЯ ПОЛЬЗОВАТЕЛЯ ?>
        <?php echo $form->error($participant, 'username', array('class'=>'error-message em-1')); //ИМЯ ПОЛЬЗОВАТЕЛЯ ?>

        <p class="sub2">ИМЯ*:</p>
        <?php echo $form->textField($participant, 'first_name', array('class'=>'textbox2')); //ИМЯ ?>
        <?php echo $form->error($participant, 'first_name', array('class'=>'error-message em-2')); //ИМЯ ?>

        <p class="sub2-1">ФАМИЛИЯ*:</p>
        <?php echo $form->textField($participant, 'last_name', array('class'=>'textbox2-1')); //ФАМИЛИЯ ?>
        <?php echo $form->error($participant, 'last_name', array('class'=>'error-message em-3')); //ФАМИЛИЯ ?>



                  <p class="sub3-1">ДАТА РОЖДЕНИЯ*:</p>
                <input class="textbox3-1" type="text">
                <input class="textbox3-2" type="text">
                <input class="textbox3-3" type="text">




                   <p class="shag-1-1-option1text">  СТРАНА*:</p>
                   <input type="checkbox" name="checkboxG51" id="checkboxG51" class="css-checkbox1" checked="checked"/><label for="checkboxG51" class="css-label1"></label>
               <a href="#"  class="vopros1" title="разрешить показывать всем пользователям"></a>
        <select class="shag-1-1-option1">
                  <option value="volvo">РОССИЯ</option>
                  <option value="saab">РОССИЯ2</option>

        </select>


                 <input type="checkbox" name="checkboxG52" id="checkboxG52" class="css-checkbox2" checked="checked"/><label for="checkboxG52" class="css-label2"></label>
               <p class="shag-1-1-option2text">ГОРОД*: </p>
              <a href="#" class="vopros2" title="разрешить показывать всем пользователям"></a>
         <select  class="shag-1-1-option2">
              <option value="saab">МОСКВА</option>
              <option value="saab">МОСКВА2</option>

         </select>


                    <p class="shag-1-1-option1-1text">  SKYPE:</p>
             <input type="checkbox" name="checkboxG5" id="checkboxG53" class="css-checkbox3" checked="checked"/><label for="checkboxG53" class="css-label3"></label>
        <a href="#"  class="vopros1-1" title="разрешить показывать всем пользователям"></a>
        <?php echo $form->textField($participant, 'skype', array('class'=>'shag-1-1-option1-1')); //skype ?>
        <?php echo $form->error($participant, 'skype', array('class'=>'error-message em-0')); //skype ?>
<!--          <input class="shag-1-1-option1-1" type="text">-->



            <p class="sub1-1">VIBER / МОБИЛЬНЫЙ*:</p>
<!--            <input class="textbox1-1" type="text">-->
            <?php echo $form->textField($participant, 'phone', array('class'=>'textbox1-1')); //VIBER / МОБИЛЬНЫЙ ?>
            <?php echo $form->error($participant, 'phone', array('class'=>'error-message em-0')); //VIBER / МОБИЛЬНЫЙ ?>
            <p class="sub2-3">ТЕКУЩИЙ ПАРОЛЬ*:</p>
<!--            <input class="textbox2-3" type="password">-->
            <?php echo $form->textField($participant, 'password', array('class'=>'textbox2-3')); //ТЕКУЩИЙ ПАРОЛЬ ?>
            <?php echo $form->error($participant, 'password', array('class'=>'error-message em-0')); //ТЕКУЩИЙ ПАРОЛЬ ?>
           <p class="sub2-4">НОВЫЙ ПАРОЛЬ*:</p>
            <input class="textbox2-4" type="password">
            <p class="sub2-5">НОВЫЙ КОШЕЛЕК:</p>
            <input class="textbox2-5" type="text">
            <a href="#" class="pm1"></a>






                <p class="shag-1-1-option2-1text">EMAIL*: </p>
                   <input type="checkbox" name="checkboxG5" id="checkboxG54" class="css-checkbox4" checked="checked"/><label for="checkboxG54" class="css-label4"></label>
                <a href="#" class="vopros2-1" title="разрешить показывать всем пользователям"></a>
             <input class="shag-1-1-option2-1" type="text" value="">







                   <p class="shag-1-1-option3text">  МОЕ ВРЕМЯ:</p>
         <select class="shag-1-1-option3">
              <option value="volvo">МОСКВА</option>
              <option value="saab">МОСКВА2</option>

        </select>


               <p class="shag-1-1-option3-1text">  ЯЗЫК:</p>
         <select class="shag-1-1-option3-1">
              <option value="volvo">РУССКИЙ</option>
              <option value="saab">РУССКИЙ2</option>

        </select>

            <p class="shag-1-1-option5text">  ВАШ КОШЕЛЕК</p>
            <p class="dannie">  ПЛАТЕЖНЫЕ ДАННЫЕ:</p>
          <input class="textbox5" type="text">
                 <a href="#"  class="pm2"></a>





         <p class="shag-1-1-option4text">  АВАТАР:</p>
              <div id="shag-1-1-avatar"></div>
          <a href="#"><div id="shag-1-1-vibrat">ВЫБРАТЬ ИЗОБРАЖЕНИЕ</div></a>

         <?php echo CHTML::submitButton('СОХРАНИТЬ',array('class'=>'btn-style-green','name'=>'btn')) ?>


        <?php $this->endWidget(); ?>
<!--          <a href="#"><input type="button" name="btn"  class="btn-style-green" value="СОХРАНИТЬ" /></a>-->
           <div id="popup-1" class="p-6-popup"><span>wddwdw fd fd df df</span><img class="stick" src="images/popupstick.png" width="13"></div>
           <div id="popup-2" class="p-6-popup"><span>wddwdw gfgfgfd ffgfd df df</span><img class="stick" src="images/popupstick.png" width="13"></div>
           <div id="popup-3" class="p-6-popup"><span>wddwdw fd fdfgffg df dfgfgfgf</span><img class="stick" src="images/popupstick.png" width="13"></div>
           <div id="popup-4" class="p-6-popup"><span>wddwdw ffgfgd fgfgfd df df</span><img class="stick" src="images/popupstick.png" width="13"></div>

    </div>

            <div><a  id="logo" href="index.html"> </a></div>

        </div>





          </div>
        <div class="wrap"></div>

    </div>
