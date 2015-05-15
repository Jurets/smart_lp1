<?php
/**
 * @var $model
 */
//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style-office.css');

?>
<div class="info">
    <?php echo Yii::app()->user->getFlash('success');?>
    <?php echo Yii::app()->user->getFlash('fail'); ?>
</div>

<div id="main-div">
    <?php 
        /* три отдельных партиала в зависимости от метки в $data: 
         * первая форма оплаты, 
         * форма "Продолжить" 
         * текст-поздравление со вступлением в клуб */
         if($data['sign'] == 'pay'){ // форма на оплату всей суммы
             $this->renderPartial('_pay', array('data'=>$data));
         }
         if($data['sign'] == 'confirm'){ // форма для трех транзакций
             $this->renderPartial('_confirm', array('data'=>$data));
         }
         if($data['sign'] == 'congratulate'){ // текст поздравления
             $this->renderPartial('_congratulate', array('data'=>$data));
         }
    ?>
    
</div>

<style>
.info{
    position: absolute;
    top:110px;
}
#main-div{
    position: absolute;
    top:150px;
	color: #FFF;
}
div#darkBGG{
    display: none;
}

div#whiteBG{
    display: none;
}

div.footer{
    margin-top: 0px;
    height: 240px;
    padding-top: 58px;
}
div.footer #footer{
    top: 0;
}

div#contentBG{
    height: 930px;
}

div#footer-bark-bg{
    top: 0px;
}

.moveRight2 {
    background-position: 80px;
}

a#endText {
    left: 182px;
}

input[type='submit']{
 /*   background-image: url("../images/up-status-button.png");
    height: 40px !important;
    font-weight: bold !important;
    padding-top: 0px;
    padding-bottom: 35px;
    border: 0px;
    color: #ffffff;
*/	
	
  height: 42px !important;
  position: absolute;
  width: 253px;
  border: solid 0px #000000;
  font-size: 25px !important;
  color: #ffffff;
  padding: 1px 17px;
  padding-bottom: 5px;
  font-weight: bold;
  cursor: pointer;
  background-color: #30c70a;
  box-shadow: 0px 1px 1px #2d500a;
  font-family: 'Open Sans Condensed', 'sans-serif';
  font-weight: bold !important;
  z-index: 1;
  transition-timing-function: ease;
  transition-property: all;
  transition-duration: .2s;
		
}

</style>