<p id="shag-2-1-text" > Для того чтобы иметь возможность получать средства и пополнять счет вам необходимо иметь кошелек Perfect Money </p>

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
    <p class="shag-2-1-sub2">Введите свой PM кошелек </p>
    <?php echo $form->error($participant, 'purse', array('class'=>'error-message em-2')); //логин ?>

    <p class="shag-2-1-sub3">
         У меня нет <label for="name"> 
    </p>
    <!--<input id="name" class="shag-2-1-textbox1" type="text"> -->
    <p class="shag-2-1-sub4">После того как вы создадите свой кошелек, введите его номер на этой странице</p>

    <!--<a href="#"><input type="button" name="btn"  class="btn-style-green btn-style-green-2-1" value="ДАЛЕЕ" /></a>-->

    <?php echo CHtml::submitButton(BaseModule::t('common', 'Next'), array(
        'name'=>'regpurse',
        'class'=>'btn-style-green btn-style-green-2-1',
    )); ?>

<?php $this->endWidget(); ?>


<a href="https://perfectmoney.is/signup.html" target="_blank"><input type="button" name="btn"  class="btn-style-blue btn-style-blue-2-1" value="СОЗДАТЬ КОШЕЛЕК" /></a>
