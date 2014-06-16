<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'invitation-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'videoLink',array('span'=>5,'maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model, 'fileLink', array('span'=>5, 'maxlength'=>255)); ?>

    <?php if(isset($model) && is_array($model->bannerFiles) && count($model->bannerFiles) > 0) { ?>

        <?php foreach($model->bannerFiles as $key => $image) { ?>
            <div class="copy">
                <div>
                   <span class="mr">банер</span><?php echo CHtml::textField("bannerFiles[$key][name]" ,"$image[name]", array('readonly'=>1)); ?>
                    <?php echo CHtml::fileField("bannerFiles[$key]"); ?>
                    <span class="icon-trash" title="<?php echo InvitationModule::t('Delete') ; ?>" onclick="$(this).parent().remove(); return false;"> </span>
                </div>
                <div></div>
            </div>

        <?php } ?>
        <div class="copy">
            <div>
                <span class="mr">банер</span><?php echo CHtml::textField("bannerFiles[][name]", '', array('readonly'=>1)); ?>
                <?php echo CHtml::fileField("bannerFiles[]"); ?>
                <span class="icon-trash" title="<?php echo InvitationModule::t('Delete') ; ?>" onclick="$(this).parent().remove(); return false;"> </span>
            </div>
            <div></div>
        </div>

    <?php }else{ ?>

        <div class="copy">
            <div>
                <span class="mr">банер</span><?php echo CHtml::textField("bannerFiles[][name]", '', array('readonly'=>1)); ?>
                <?php echo CHtml::fileField("bannerFiles[]"); ?>
               <span class="icon-trash" title="<?php echo InvitationModule::t('Delete') ; ?>" onclick="$(this).parent().remove(); return false;"> </span>
            </div>
            <div></div>
        </div>

    <?php } ?>
    <div></div>
    <?php echo TbHtml::button(InvitationModule::t('Добавить'), array(
        'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
        'size'=>TbHtml::BUTTON_SIZE_SMALL,
        'rel'=>'.copy',
        'id'=>'addSlider',
    )); ?>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(InvitationModule::t('Применить'), array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_LARGE,
        )); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>