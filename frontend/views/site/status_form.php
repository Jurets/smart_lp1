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

        <?php
        if($model->tariff_id >= 2){
        ?>
        <p>Чтобы поднять ваш статус необходимо сделать взнос.</p>
        <?php echo CHtml::label('Сумма: ','listData');
            $list = CHtml::listData($tariffListData,'shortname','shortname');
            echo CHtml::dropDownList('listData',100,$list,array('id'=>'dropDownId'));
        }elseif($model->tariff_id < 2){ ?>
            <p>Сначала вы должны оплатить за регистрацию 50$ после этого вам будет доступен 'Бизнес Клуб'</p>
            <input id="sum" type="hidden" value="50">

        <?php }
        $this->renderPartial('application.views.site._payform');
        ?>
</div>



<style>
#main-div{
    position: absolute;
    top:150px;
}
</style>
