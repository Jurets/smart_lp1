<div class="row buttons">
    <?php //echo $form->hiddenField($model, 'image'); ?>
    <?php echo CHtml::activeHiddenField($model, 'image'); ?>
    <?php //$form->label($model, 'Upload illustration') ?>
    <?php echo CHtml::activeLabel($model, 'Upload illustration') ?>

    <div class="news-image-preview" id="news-image-preview" style="width: 336px; height: 160px; border: 1px solid gray; background: url('<?php
            echo (isset($model->image)) ? $model->UploadImage : '/admin/img/img-gate.png';
        ?>') no-repeat;">
    </div>
    <br/>

    <span class="" id='select-image'>
        <!-- The file input field used as target for the file upload widget -->
        <?php echo CHtml::activefileField($model, 'illustration', array('name'=>'files[]', 'id'=>'fileupload')); ?>
    </span>
    <div id='uploader-progress'></div>
</div>

<div class="row">&nbsp;</div>

<script>
    $(function() {
        var url = "<?=$this->controller->createAbsoluteUrl('upload')?>";
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
        var img = "<img id='cropbox'  src='" +  '/admin' + imagePath + "'/>";
        //var img = '<img id="cronbox" src="/uploads/' + imagePath + '"/>';
        $("#news-image-preview").empty().append(img);
        //$("#News_image").val(imagePath);
        $("#News_image").val(imageName);
    }
</script>