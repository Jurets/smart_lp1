<?php
/**
 * @var $model
 */
//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style-office.css');

?>

<div id="main-div">
    <!-- current status -->
    <p>Ваш статус : <?php echo $status['name'];?></p>

    <div id="div-status-form">
        <?php
        if($model->tariff_id >= 2){
        ?>
        <p>Чтобы поднять ваш статус необходимо сделать взнос.</p>
        <?php //array('100'=>100,'500'=>500,'1000'=>1000)
            echo CHtml::label('Сумма: ','listData');
            $list = CHtml::listData($tariffListData,'id','shortname');
            echo CHtml::dropDownList('listData',100,$list);
        }elseif($model->tariff_id < 2){ ?>
            <p>Сначала вы должны оплатить за регистрацию 50$ после этого вам будет доступен 'Бизнес Клуб'</p>
            <input id="cost" type="hidden" value="50">

        <?php }
        $this->renderPartial('application.views.site._payform');
        ?>
    </div>
</div>



<style>
#cost{
    margin-left:20px;
}
#account{
    margin-left:30px;
}
#password{
    margin-left:35px;
}
#main-div{
    position: absolute;
    top:150px;
}
#div-status-form input{
    margin-top : 10px;
    margin-bottom : 10px;
}
</style>