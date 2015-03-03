<p id="shag-4-2-text">
    <?php echo BaseModule::t('rec', 'Congratulations! You became a full member of the system.') ?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'enableAjaxValidation'=>false)); 
    echo CHtml::activeHiddenField($participant, 'postedActivKey', array('value'=>$participant->activkey)); 
    echo CHtml::submitButton(BaseModule::t('rec','ENTER TO OFFICE'), array(
            'name'=>'login',
            'class'=>'btn-style-green btn-style-green-4-2',
            'style'=>'cursor: pointer;',
    ));
    
$this->endWidget();
?>
<div>
    <a id="logo" href="index.html"> </a>
</div>