<p id="shag-4-2-text" > <?php echo Yii::t('common', 'Congratulations! You became a full member of the system.') ?></p>
<!--<div>
    <input type="button" name="login" class="btn-style-green btn-style-green-4-2" value="ВОЙТИ В ОФИС" />
</div>-->

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'enableAjaxValidation'=>false)); 
    echo CHtml::activeHiddenField($participant, 'postedActivKey', array('value'=>$participant->activkey)); 
    echo CHtml::submitButton('ВОЙТИ В ОФИС', array(
            'name'=>'login',
            'class'=>'btn-style-green btn-style-green-4-2',
            'style'=>'cursor: pointer;',
    ));
    
$this->endWidget();
?>
<div><a  id="logo" href="index.html"> </a></div>