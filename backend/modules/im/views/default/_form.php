<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'indexmanager-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<?php echo $form->errorSummary($model); ?>
    
  <?php echo $form->textFieldControlGroup($model,'videolink',array('span'=>5,'maxlength'=>255)); ?>
  <?php echo $form->textFieldControlGroup($model, 'title', array('span'=>5, 'maxlength'=>255)); ?>
  <?php echo $form->textAreaControlGroup($model, 'about', array('span'=>5, 'maxlength'=>255)); ?>  
    
  <?php if(isset($model) && is_array($model->sliderlist) && count($model->sliderlist) > 0) { ?>
    
    <?php foreach($model->sliderlist as $ind => $slider) { ?>
    <?php if(!isset($slider['leader'])) {echo '-==- '.$ind; continue;} ?>
    <div class="copy">
        <div>
        <span class="mr"><?php echo BaseModule::t('rec','leader')?></span><?php echo CHtml::textField("sliderlist[$ind][leader]", $slider['leader']);?>
        <span class="mr"><?php echo BaseModule::t('rec','Photo')?></span><?php echo CHtml::textField("sliderlist[$ind][photo]", $slider['photo'], array('readonly'=>1)); ?>
        <?php echo CHtml::fileField("sliderlist[$ind][photo_source]"); ?>
        <?php echo CHtml::label(BaseModule::t('rec','Descriptio'), NULL); ?>
        <?php echo CHtml::textArea("sliderlist[$ind][descriptio]", $model->sliderlist[$ind]['descriptio'], array(
            'maxlength'=>350,
            'style'=>"width:600px;height:100px;"
        )); ?>
        <span class="icon-trash" title="<?php echo BaseModule::t('rec','Delete') ; ?>" onclick="$(this).parent().remove(); return false;"> </span>
        </div>
        <div></div>
    </div>
    <?php } ?>
    
  <?php }else{ ?>
    
    <div class="copy">
        <div>
        <span class="mr"><?php echo BaseModule::t('rec','leader')?></span><?php echo CHtml::textField("sliderlist[0][leader]"); ?>
        <span class="mr"><?php echo BaseModule::t('rec','Photo')?></span><?php echo CHtml::textField("sliderlist[0][photo]", '', array('readonly'=>1)); ?>
        <?php echo CHtml::fileField("sliderlist[0][photo_source]"); ?>
        <?php echo CHtml::label(BaseModule::t('rec','Descriptio'), NULL); ?>
        <?php echo CHtml::textArea("sliderlist[0][descriptio]",'', array('style'=>"width:600px;height:100px;")); ?>
        <span class="icon-trash" title="<?php echo BaseModule::t('rec','Delete') ; ?>" onclick="$(this).parent().remove(); return false;"> </span>
        </div>
        <div></div>
    </div>
    
  <?php } ?>
    <div></div>
   <?php echo TbHtml::button(BaseModule::t('rec','Add'), array(
                    'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
		    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                    'rel'=>'.copy',
                    'id'=>'addSlider',
                )); ?>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(BaseModule::t('rec','Create'), array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>
<?php $this->endWidget(); ?>
</div>