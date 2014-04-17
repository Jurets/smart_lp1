<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)); 
?>

	<!--  <p class="note">Fields with <span class="required">*</span> are required.</p>  -->

	<?php echo $form->errorSummary($model); ?>

	<!-- <div class="row">
		<?php //echo $form->labelEx($model,'author'); ?>
		<?php //echo $form->textField($model,'author'); ?>
		<?php //echo $form->error($model,'author'); ?>
	</div>  -->

	<!-- <div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'activated'); ?>
		<?php echo $form->textField($model,'activated'); ?>
		<?php /*$this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                    'name'=>'News[_activated]',
                    'id'=>'News_activated',
                    'value'=>$model->activated,
                    'format' => 'yyyy-MM-dd hh:mm:ss',
                    'pluginOptions' => array(
                        //'language' => Yii::app()->language,
                    ),
                ));*/
            ?>
		<?php echo $form->error($model,'activated'); ?>
	</div>
	
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<!--  <div class="row">
		<?php //echo $form->labelEx($model,'announcement'); ?>
		<?php //echo $form->textField($model,'announcement',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'announcement'); ?>
	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<!-- <div class="row">
		<?php //echo $form->labelEx($model,'image'); ?>
		<?php //echo $form->textField($model,'image',array('size'=>15,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'image'); ?>
	</div>-->
	
	<div class="row buttons">
	
	<?php echo $form->hiddenField($model, 'image'); ?>
    <?php $form->label($model, 'Upload illustration') ?>

    <div class="news-image-preview" id="news-image-preview" style="width: 336px; height: 160px; border: 1px solid gray; background: url('<?php
		echo (isset($model->image)) ? $model->UploadImage : '/img/img-gate.png';
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
<!--  <img src="http://justmoney-admin.smart/files/apple-touch-icon.png" /> -->
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
                	//showOverlay(file.original, file.name);
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
        $("#News_image").val(imageName);
    }
</script>