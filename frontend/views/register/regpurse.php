<p id="shag-2-1-text" > <?php echo BaseModule::t('rec', 'In order to be able to receive funds and make deposits, you must have a Perfect Money purse'); ?></p>

<p class="shag-2-1-sub1">
    У меня есть 
    <label for="name1">
        <img src="/images/pm.png" class="pm" width="30">
    </label>
</p>

<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'regpurse-form',
    'enableAjaxValidation'=>false,
    //'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

    <?php echo $form->textField($participant, 'purse', array('class'=>'shag-2-1-textbox1')); //email ?>
    <!--<input id="name1" class="shag-2-1-textbox1" type="text"> -->
    <p class="shag-2-1-sub2"><?php echo BaseModule::t('rec', 'Enter your PM purse'); ?></p>
    <?php echo $form->error($participant, 'purse', array('class'=>'error-message em-2')); //логин ?>

    <p class="shag-2-1-sub3">
         У меня нет <label for="name"> 
    </p>
    <!--<input id="name" class="shag-2-1-textbox1" type="text"> -->
    <p class="shag-2-1-sub4"><?php echo BaseModule::t('rec', 'After you create your purse, put a number on this page'); ?></p>

    <!--<a href="#"><input type="button" name="btn"  class="btn-style-green btn-style-green-2-1" value="ДАЛЕЕ" /></a>-->

    <?php echo CHtml::submitButton(BaseModule::t('common', 'Next'), array(
        'name'=>'regpurse',
        'class'=>'btn-style-green btn-style-green-2-1',
    )); ?>

<?php $this->endWidget(); ?>


<a href="https://perfectmoney.is/signup.html" target="_blank"><input type="button" name="btn"  class="btn-style-blue btn-style-blue-2-1" value="<?php echo strtoupper(BaseModule::t('rec', 'Create purse')); ?>" /></a>
