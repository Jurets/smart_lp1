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
        if(isset($arrCategories['finance'])){
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

        <?php if(isset($arrCategories['offer'])){
        foreach($arrCategories['offer'] as $offer)
        {
            echo $offer['question'];
            echo $offer['answer'];
            echo '<hr>';
        }
        }else{ echo 'Нет данных.'; }
        ?>
    </div>
    <h3><?php echo Yii::t('common', 'Site work') ?></h3>
    <div class="accordionContent">
        <?php
        if(isset($arrCategories['site'])){
            foreach($arrCategories['site'] as $site)
            {
                echo $site['question'];
                echo $site['answer'];
                echo '<hr>';
            }
        }else{ echo 'Нет данных.'; }

        ?>
    </div>
</div>
<div id='popup'>
    <div id="help-7-2">
        <?php echo CHtml::beginForm('','post'); ?>
        <p class="sub1">ВЫБЕРИТЕ ТЕМУ СООБЩЕНИЯ:</p>
        <p class="sub2">ВАШ ВОПРОС:</p>
        <?php echo CHtml::dropDownList('category','',$availableCategories,array('class'=>'help-option')); ?>
        <?php echo CHtml::textArea('question','',array('id'=>'helpText')) ?>
<!--        <textarea id="helpText"> </textarea>-->
        <a id="close-popup" href="#"><img src="images/Х.png" width="22"></a>
        <?php echo CHtml::submitButton('',array('name'=>'btn','class'=>'btn-style-green-7-2','value'=>'ЗАДАТЬ ВОПРОС')) ?>
        <?php echo CHtml::endForm(); ?>
    </div>
</div>

<script>
    $("#accordion").accordion();
    $('#popup').hide()
    $(document).ready(function () {
        $('#popupbtn').on("click", function () {

            $('#popup').show()
            $('#close-popup').on('click', function () {

                $('#popup').hide()

            })
        })

    });
</script>