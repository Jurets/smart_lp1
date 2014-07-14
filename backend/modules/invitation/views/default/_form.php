<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'invitation-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'videoLink', array('span' => 5, 'maxlength' => 255)); ?>
    <?php echo $form->textFieldControlGroup($model, 'fileLink', array('span' => 5, 'maxlength' => 255)); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php
        $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
            'model' => $model,
            'attribute' => 'text',
            'pluginOptions' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => true,
            ),));
        ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <?php if (isset($model) && is_array($model->bannerFiles) && count($model->bannerFiles) > 0) { ?>

        <?php foreach ($model->bannerFiles as $key => $image) { ?>
            <div class="copy">
                <div>
                    <span class="mr"><?php echo Yii::t('common', 'Banner') ?></span><?php echo CHtml::textField("bannerFiles[$key][name]", $image['name'], array('readonly' => 1)); ?>
                    <?php echo CHtml::fileField("bannerFiles[$key]['photo_s']"); ?>
                    <span class="icon-trash" title="<?php echo Yii::t('common', 'Delete'); ?>" onclick="$(this).parent().remove();
                                    return false;"> </span>
                </div>
                <div></div>
            </div>

        <?php } ?>


    <?php } else { ?>

        <div class="copy">
            <div>
                <span class="mr"><?php echo Yii::t('common', 'Banner') ?></span><?php echo CHtml::textField("bannerFiles[0][name]", '', array('readonly' => 1)); ?>
                <?php echo CHtml::fileField("bannerFiles[0]['photo_s']"); ?>
                <span class="icon-trash" title="<?php echo Yii::t('common', 'Delete'); ?>" onclick="$(this).parent().remove();
                            return false;"> </span>
            </div>
            <div></div>
        </div>

    <?php } ?>
    <div></div>
    <?php
    echo TbHtml::button(Yii::t('common', 'Add'), array(
        'color' => TbHtml::BUTTON_COLOR_DEFAULT,
        'size' => TbHtml::BUTTON_SIZE_SMALL,
        'rel' => '.copy',
        'id' => 'addSlider',
    ));
    ?>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton(Yii::t('common', 'Apply'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'name' => 'invitationSubmit'
        ));
        ?>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    $('[name="invitationSubmit"]').click(function() {
        var text = $('#Invitation_text').val();
        text = text.replace(/[(\s{2,})(\n)]/g, ' ');
        $('#Invitation_text').val(text);
        $(this).submit();
    });
</script>