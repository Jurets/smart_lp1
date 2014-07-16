<?php
/**
 * $this OfficeController
 * @var $arrCategories
 */
Yii::app()->clientScript->registerCssFile('/css/style-office.css');
Yii::app()->clientScript->registerScriptFile('/js/jquery-ui.min.js');
?>
<div id="office7-1-content">
    <a href="#" id='popupbtn' ><input type="button" name="btn"  class="btn-style-green-7-1" value="ЗАДАТЬ ВОПРОС" /></a>
</div>

<div id="accordion">
    <h3><?php echo Yii::t('common', 'Finance') ?></h3>
    <div class="accordionContent">
        <?php
        if(!empty($arrCategories)){
        foreach($arrCategories['finance'] as $finance)
        {
            echo $finance['question'];
            echo $finance['answer'];
            echo '<hr>';
        }
        }else{ echo 'Нет данных.'; }
        ?>
    </div>
    <h3><?php echo Yii::t('common', 'Offers') ?></h3>
    <div class="accordionContent">

        <?php if(!empty($arrCategories)){
        foreach($arrCategories['offer'] as $finance)
        {
            echo $finance['question'];
            echo $finance['answer'];
            echo '<hr>';
        }
        }else{ echo 'Нет данных.'; }
        ?>
    </div>
    <h3><?php echo Yii::t('common', 'Site work') ?></h3>
    <div class="accordionContent">
        <?php
        if(!empty($arrCategories)){
            foreach($arrCategories['site'] as $finance)
            {
                echo $finance['question'];
                echo $finance['answer'];
                echo '<hr>';
            }
        }else{ echo 'Нет данных.'; }

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