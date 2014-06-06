<?php
/**
 * $this OfficeController
 * @var $arrCategories
 */
Yii::app()->clientScript->registerCssFile('/css/style-office.css');
Yii::app()->clientScript->registerScriptFile('/js/jquery-ui.min.js');
?>
<div id="office7-1-content">
    <div><a  id="logo" href="index.html"> </a></div>
    <a href="#" id='popupbtn' ><input type="button" name="btn"  class="btn-style-green-7-1" value="ЗАДАТЬ ВОПРОС" /></a>
</div>

<div id="accordion">
    <h3>Финансы</h3>
    <div class="accordionContent">
        <?php  foreach($arrCategories['finance'] as $finance)
        {
            echo $finance['question'];
            echo $finance['answer'];
            echo '<hr>';
        }
        ?>
    </div>
    <h3>Предложения</h3>
    <div class="accordionContent">
        <?php  foreach($arrCategories['offer'] as $finance)
        {
            echo $finance['question'];
            echo $finance['answer'];
            echo '<hr>';
        }
        ?>
    </div>
    <h3>Работа сайта</h3>
    <div class="accordionContent">
        <?php  foreach($arrCategories['site'] as $finance)
        {
            echo $finance['question'];
            echo $finance['answer'];
            echo '<hr>';
        }
        ?>
    </div>
</div>


<script>
$( "#accordion" ).accordion();
$('#popup').hide()
$( document ).ready(function() {
$('#popupbtn').on("click",function (){

$('#popup').show()
$('#close-popup').on('click',function(){

$('#popup').hide()

})
})

});
</script>