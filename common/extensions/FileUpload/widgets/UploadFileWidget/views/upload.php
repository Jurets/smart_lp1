<div class="row buttons">
    <?php //echo $form->hiddenField($model, 'image'); ?>
    <?php echo CHtml::activeHiddenField($model, 'image'); ?>
    <?php //$form->label($model, 'Upload illustration') ?>
    <?php echo CHtml::activeLabel($model, BaseModule::t('rec','Upload Illustration')) ?>

    <div class="news-image-preview" id="news-image-preview" style="width: <?php echo $params['width'];?>px; height: <?php echo $params['height'];?>px; border: 1px solid gray; background: url('<?php
            echo (isset($model->image)) ? $model->UploadImage : '' /*/admin/img/img-gate.png';*/
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
        var url = "<?=$this->controller->createAbsoluteUrl('upload', array('w'=>$params['width'], 'h'=>$params['height'], 'org_w'=>$re_org['width'], 'org_h'=>$re_org['height']))?>";
        $('#fileupload').fileupload({
            url: url,
            //data: ['w':<?=$params['width']?>, 'h':$params['height'], 'org_w'=>$re_org['width'], 'org_h'=>$re_org['height']],
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
            }
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