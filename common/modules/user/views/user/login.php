<?php
// TODO Переделать форму
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form">
<?php $this->beginWidget('CActiveForm', array(
    'id'=>'login',
    //'action'=>Yii::app()->createAbsoluteUrl('site/login'),
    'enableAjaxValidation'=>true,
    //'enableClientValidation'=>true,
    //'focus'=>'input:visible:enabled:first',//array($userLogin, 'username'),
    'clientOptions'=>array(
        'validateOnChange'=>false,
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo CHtml::errorSummary($model); ?>
    
    <div class="row">
        <?php echo CHtml::activeLabelEx($model,'role'); ?>
        <?php echo CHtml::activeDropDownList($model,'role',array( 'суперадмин', 'админ', 'модератор')) ?>
    </div>
    	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
        <?php echo CHtml::activeTextField($model,'username') ?>
		<?php echo CHtml::error($model,'username') ?>
	</div>
    
    <div class="row">
        <?php echo CHtml::activeLabelEx($model,'password'); ?>
        <?php echo CHtml::activePasswordField($model,'password') ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::activeLabelEx($model,'activekey'); 
              $class = empty($model->logincode) ? 'invisible' : ''; 
              echo CHtml::link(UserModule::t('Generate login code'), '#', array('id'=>'temp_key_link')); 
        ?>
        <br>
        <div id="show-errors" class="error"></div>
        <p class="<?php echo $class; ?>">Код был выслан вам на почту. Введите его в поле ниже:</p>
        <?php echo CHtml::activeTextField($model,'activekey', array('class'=>$class . ' temp-key')) ?>
    </div>
	
	<div class="row">
        <?=CHtml::activeLabelEx($model, 'verifyCode')?>
        <?php $this->widget('CCaptcha')?>
        <?=CHtml::activeTextField($model, 'verifyCode')?>
	</div>
	
	<div class="row">
		<p class="hint">
		<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Login")); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>