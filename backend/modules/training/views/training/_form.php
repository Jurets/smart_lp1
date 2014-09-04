<?php
/* @var $this TrainingController */
/* @var $model Training */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'training-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo BaseModule::t('rec', 'Fields with * are required.'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'image'); ?>
<!--		--><?php //echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
<!--		--><?php //echo $form->error($model,'image'); ?>
<!--	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,BaseModule::t('rec','Video Link')); ?>
		<?php echo $form->textField($model,'videolink',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'videolink'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                'model' => $model,
                'name' => 'date',
                'attribute' => 'date',
                'format' => 'yyyy-MM-dd hh:mm:ss',
            ))
        ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>


    <div class="row buttons">

        <?php echo $form->hiddenField($model, 'image'); ?>
        <?php $form->label($model, 'Upload illustration') ?>
        <div class="news-image-preview" id="news-image-preview" style="width: 336px; height: 160px; border: 1px solid gray; background: url('<?php
        //echo (isset($model->image)) ? $this->module->uploadUrl .'resized-'. $model->image : '/img/img-gate.png';
        if(isset($model->image)) {
            echo $this->module->uploadUrl .'resized-'. $model->image;
        }else{
        }
        ?>') no-repeat;">
        </div>
        <br/>
    <span class="" id='select-image'>

        <!-- The file input field used as target for the file upload widget -->
        <?php echo CHtml::activefileField($model, 'illustration', array('name'=>'files[]', 'id'=>'fileupload')); ?>
        <?php //echo CHtml::button('illustration', array('name'=>'files[]', 'id'=>'fileupload')); ?>
    </span>
        <div id='uploader-progress'></div>
    </div>

    <!-- <div class="row">
		<?php //echo $form->labelEx($model,'activity'); ?>
		<?php //echo $form->textField($model,'activity'); ?>
		<?php //echo $form->error($model,'activity'); ?>
	</div> -->
    <div class="row">&nbsp;</div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? BaseModule::t('rec','Create') : BaseModule::t('rec','Save')); ?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $(function() {
        var url = "<?=$this->createAbsoluteUrl('upload')?>";

        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            send: function(e, data) {
                //$("#select-image").hide();
                $("#uploader-progress").empty().html("Загружается изображение. Пожалуйста, подождите");
            },
            done: function(e, data) {
                $.each(data.result.files, function(index, file) {
                    showOverlay(file.resized, file.name);
                });
                $("#uploader-progress").empty().html("Изображение успешно загружено!");
            },
        });
    });

    function showOverlay(imagePath, imageName) {
        var img = "<img id='cropbox'  src='" + imagePath + "'/>";
        //var img = '<img id="cronbox" src="/uploads/' + imagePath + '"/>';
        $("#news-image-preview").empty().append(img);
        //$("#News_image").val(imagePath);
        $("#Training_image").val(imageName);
        $("#news-image-preview")
    }
</script>