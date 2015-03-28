<?php
/**
 *  Частичное представление для авторизованного входа
 */
?>

<style type="text/css" id="style-login">
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


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login',
    'action' => Yii::app()->createAbsoluteUrl('site/login'),
    'enableAjaxValidation' => true,
    //'enableClientValidation'=>true,
    'focus' => 'input:visible:enabled:first', //array($userLogin, 'username'),
    'clientOptions' => array(
        'validateOnChange' => false,
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'style' => "font-family: 'Open Sans Condensed','sans-serif'; position: absolute;"
    ),
        ));
?>

<p class="sub1" id ="sub1-login"><?php echo BaseModule::t('rec', 'USERNAME') ?>:</p>
<?php echo CHtml::activeTextField($userLogin, 'username', array('class' => 'textbox1 textbox1-login')); ?>
<?php echo $form->error($userLogin, 'username', array('style' => 'top: 15px;')); ?>

<p class="sub2" id="sub2-login"><?php echo BaseModule::t('rec', 'PASSWORD') ?>:</p>
<?php echo CHtml::activePasswordField($userLogin, 'password', array('class' => 'textbox2 textbox2-login')); ?>
<?php echo $form->error($userLogin, 'password', array('style' => 'top: 82px;')); ?>

<?php
$this->widget('CCaptcha', array(
    'captchaAction' => 'site/captcha',
    'imageOptions' => array('id' => 'captcha'),
    'buttonOptions' => array('id' => 'refresh'),
))
?>

<p class="sub3" id="sub3-login"><?php echo BaseModule::t('rec', 'ENTER THE CODE') ?>:</p> 
<?php echo CHtml::activeTextField($userLogin, 'verifyCode', array('class' => 'textbox3 textbox3-login')); ?>
<?php echo $form->error($userLogin, 'verifyCode', array('style' => 'top: 202px;')); ?>

<?php echo CHtml::submitButton(BaseModule::t('rec', 'LOGIN'), array('id'=>'btn-submit','name' => 'btn',
                                                                'class' => 'btn-style',
                                                                 'style' => 'font-family: \'Open Sans Condensed\',\'sans-serif\' !important')); ?>

<a href="#" id="sub4"><?php echo BaseModule::t('rec', 'FORGOT YOUR PASSWORD?') ?></a>
<?php $this->endWidget(); ?>
<?php if(isset($actionLoginWindowDisplayPatch)  && $actionLoginWindowDisplayPatch === 1) {?>
<style>
    #login {
        display: block;
    }
</style>
<?php } else { ?>
<style>
    #login {
        display: none;
    }
</style>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        //$('#login').hide();
        $('.open-login, .in').on("click", function() {
            if ($('#login').css('display') != 'none') {
                $('#login').hide()
            } else {
                $('#login').show();
            }
        });
        $('#UserLogin_username').focusout(function(){
            var action = $('#login').attr('action');
           // if(action.indexOf('.justmoney') === -1){
                checkDomainName($(this).val());
           // }
        });
        return false;
    });
    
 function checkDomainName(email){
     $.post(
        '<?php echo Yii::app()->createAbsoluteUrl('site/checkdomain')?>',
        {
            email: email
        },
        checkDomainSuccess
     );
 }
 function checkDomainSuccess(data){
     if (data !== 'NONE'){
        $('#login').attr('action', data);
     }
 }
</script>
