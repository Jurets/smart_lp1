<?php
// TODO Переделать форму
$this->pageTitle=Yii::app()->name . ' - '.BaseModule::t('rec',"Login");
$this->breadcrumbs=array(
	BaseModule::t('rec',"Login"),
);
?>

<h1><?php echo BaseModule::t('rec',"Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php echo BaseModule::t('rec',"Please fill out the following form with your login credentials:"); ?></p>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'login',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    //'action'=>Yii::app()->createAbsoluteUrl('site/login'),
    'enableAjaxValidation'=>true,
    //'enableClientValidation'=>true,
    //'focus'=>'input:visible:enabled:first',//array($userLogin, 'username'),
    'clientOptions'=>array(
        'validateOnChange'=>false,
        'validateOnSubmit'=>true,
    ),
)); 
    //вьюшка для сообщения о необходимых полях
    echo $this->renderPartial('backend.views.site.required');
    echo TbHtml::errorSummary($model);
?>
    <div class="control-group">
        <?php echo CHtml::label(BaseModule::t('rec', 'username') . ' <span class="required">*</span>', 'UserLogin_username', array('class'=>'control-label required')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'username')?>
        </div>
    </div>

    <div class="control-group">
        <?php echo CHtml::label(BaseModule::t('rec', 'password') . ' <span class="required">*</span>', 'UserLogin_password', array('class'=>'control-label required')); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password')?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'activekey', array('class'=>"control-label")); ?>
        <div class="controls">
              <?php $class = empty($model->logincode) ? 'invisible' : ''; 
              echo TbHtml::link(Yii::t('rec','Generate login code'), Yii::t('rec', '#'), array('id'=>'temp_key_link')); 
        ?>
        <br>
        <div id="show-errors" class="alert alert-block alert-error" style="display: none;"></div>
        <p class="<?php echo $class; ?>"><?php echo BaseModule::t('rec', 'Код был выслан вам на почту. Введите его в поле ниже'); ?>:</p>
        <?php echo CHtml::activeTextField($model,'activekey', array('class'=>$class . ' temp-key')) ?>
        </div>
    </div>
	
    <div class="control-group">
        <?php echo $form->labelEx($model, 'verifyCode', array('class'=>"control-label required")); ?>
	    <!--<div class="controls">-->
            <?php $this->widget('CCaptcha')?>
            <?php echo CHtml::activeTextField($model, 'verifyCode'); ?>
        <!--</div>-->
	</div>
	
	<div class="control-group">
        <?php echo $form->labelEx($model, 'rememberMe', array('class'=>"control-label")); ?>
        <?php //echo CHtml::label(BaseModule::t('rec', 'Remember me next time'), 'UserLogin_rememberMe', array('class'=>'control-label required')); ?>
        <div class="controls">
		    <?php echo TbHtml::activeCheckBox($model,'rememberMe'); ?>
        </div>
	</div>

	<?php echo TbHtml::submitButton(BaseModule::t('rec', "Login"), array('class'=>'btn btn-primary')); ?>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
