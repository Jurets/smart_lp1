<?php
/**
 * @var $model
 */
//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style-office.css');

?>
<div class="info">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<div id="main-div">
    <!-- current status -->
    <p>Ваш статус : <?php echo $status['name'];?></p>

    <?php
    if (!$defective_status) {
        if ($max_status) {
            ?>
            <br>
            <p>Вы достигли максимального статуса в Бизнес Клубе!</p>
        <?php
        } else {
            if ($model->tariff_id >= 2) {
                ?>
                <p>Чтобы поднять ваш статус необходимо сделать взнос.</p>
                <?php echo CHtml::label('Сумма: ', 'listData');
                $list = CHtml::listData($tariffListData, 'id', 'shortname');
                echo CHtml::dropDownList('listData', 100, $list, array('id' => 'dropDownId'));
            } elseif ($model->tariff_id < 2) {
                ?>
                <p>Сначала вы должны оплатить за регистрацию 50$ после этого вам будет доступен 'Бизнес Клуб'</p>
                <input id="sum" type="hidden" value="1">

            <?php
            }
            //вывод формы ввода аккаунта/пароля PM
            $this->renderPartial('application.views.site._payform');
        }
    } else {
        ?>
        <p><?php if($message != ''){echo $message;}?></p>
        <br>
        <p>Платежная система на данный момент не доступна.Приносим наши извинения.</p>
    <?php
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
}

#contentBG{
    min-width: 1080px;
    width: 100% ;
    height: 872px;
    background-image: url(../images/contentBG.jpg);
    position: absolute;
    top: 40px;
}


#globe{
    margin-left: auto;
    height: 487px;
    width: 782px;
    background-image: url(../images/globe.png);
    background-repeat: no-repeat;
    background-position:right;
    z-index: 0;
}

.moveRight2 {
    background-position: 80px;
}

</style>
<?php
Yii::app()->clientScript->registerScript(
    'myHideEffect',
    '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
    CClientScript::POS_READY
);
?>

<script>
    $("head link[href='/css/style.css']").attr('href', '');
</script>