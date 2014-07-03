<?php
/**
*  Частичное представление для авторизованного входа
*/
?>

<style type="text/css">
    .errorMessage {
        background-color: red;/*background-color: #F2DEDE;*/
        border-color: #EED3D7;
        color: white;/*#B94A48;*/
        border-radius: 4px;
        border-width: 6px;
        font-size: medium;
        height: 37px;
        left: 238px;
        padding-top: 0;
        position: relative;
        /*top: 33px;*/
        transition: opacity 0.15s linear 0s;
        width: 187px;
    }
    
    #refresh {
        overflow: hidden;
        text-indent: -200px;
    }    
</style>


<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'login',
    'action'=>Yii::app()->createAbsoluteUrl('site/login'),
    'enableAjaxValidation'=>true,
    //'enableClientValidation'=>true,
    'focus'=>'input:visible:enabled:first',//array($userLogin, 'username'),
    'clientOptions'=>array(
        'validateOnChange'=>false,
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array(
        'style'=>"font-family: 'Open Sans Condensed','sans-serif'; position: absolute;"
    ),
)); ?>

<p class="sub1"><?php echo Yii::t('common', 'USERNAME')?>:</p>
    <?php echo CHtml::activeTextField($userLogin, 'username', array('class'=>'textbox1')); ?>
    <?php echo $form->error($userLogin, 'username', array('style'=>'top: 15px;')); ?>

    <p class="sub2"><?php echo Yii::t('common', 'PASSWORD')?>:</p>
    <?php echo CHtml::activePasswordField($userLogin, 'password', array('class'=>'textbox2')); ?>
    <?php echo $form->error($userLogin, 'password', array('style'=>'top: 82px;')); ?>

    <?php $this->widget('CCaptcha', array(
        'imageOptions'=>array('id'=>'captcha'),
        'buttonOptions'=>array('id'=>'refresh'),
    ))?>
    
    <p class="sub3"><?php echo Yii::t('common', 'ENTER THE CODE')?>:</p> 
    <?php echo CHtml::activeTextField($userLogin, 'verifyCode', array('class'=>'textbox3')); ?>
    <?php echo $form->error($userLogin, 'verifyCode', array('style'=>'top: 202px;')); ?>

    <?php echo CHtml::submitButton(Yii::t('common', 'LOGIN'), array('name'=>'btn', 'class'=>'btn-style')); ?>

    <a href="#" id="sub4"><?php echo Yii::t('common', 'FORGOT YOUR PASSWORD?')?></a>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $('#login').hide();
    $(document).ready(function() {
        $('.open-login, .in').on("click",function (){
            if($('#login').css('display')!='none'){
                $('#login').hide()
            } else {
                $('#login').show();
            }
        })
        return false;
    });
</script>