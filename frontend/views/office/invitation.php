<?php
/**
 * $this OfficeController
 * @var $youTubeUrlUniqueId
 * @var $downloadFile
 * @var $arrBannerFiles
 * @var $content
 */
?>

<div id="office-5-content">
    <div id="office-5-bannerMainDiv">
        <?php   if(!empty($arrBannerFiles)){?>
        <div id="office-5-bannerListDiv">
            <?php foreach($arrBannerFiles as $bannerPath){ ?>
            <div class="office-5-eachBannerDiv">
                <img src="/admin/uploads/<?php echo $bannerPath['name'];?>"  width="150" height="100"  />
                <?php echo CHtml::radioButton('bannerRadioButton',false,array('class'=>'handler', 'value'=>$bannerPath['name'])); ?>

            </div>
            <?php } ?>
        </div>
            <div id="office-5-bannerSettingsDiv">
                <?php
                    echo CHtml::label(BaseModule::t('common', 'Width: '),'widthBanner');
                    echo CHtml::numberField('widthBanner','150',array('class'=>'handler'));

                    echo CHtml::label(BaseModule::t('common', 'Height: '),'heightBanner');
                    echo CHtml::numberField('heightBanner','100',array('class'=>'handler'));

                    echo '<br>';
                    echo CHtml::textArea('iframeText','',array('readonly'=>true));

                ?>
                <input class="settings-buttons" type="button" value="Закрыть" onclick="hideBannerDiv();"/>
            </div>

            <?php }else{ echo BaseModule::t('common', 'Add banners to admin panel.');
            ?> <input class="settings-buttons" type="button" value="Закрыть" onclick="hideBannerDiv();"/> <?php
        }?>
    </div>
    <h2 class="h2ContentOffice5"><?php echo BaseModule::t('common', 'INVITATION'); ?></h2>
    <a href="<?php echo $downloadFile; ?>"><input type="button" name="btn"  class="btn-style-green1" value="<?php echo BaseModule::t('common', 'DOWNLOAD') ?>" /></a>
    <a href="#"><input type="button" name="btn"  class="btn-style-green2" value="<?php echo BaseModule::t('common', 'INTERNET ADVERTISING') ?>" onclick="showBannerDiv();"/></a>


    <div id="office-5-post1">
        <div id="blogImg5">
        <?PHP
        $this->widget('ext.Yiitube', array('v' => $youTubeUrlUniqueId,'size'=>'mine'));
        ?>
        </div>
<!--        <h4 class="office-5-miniZagolovok">Автоматизированная система непрямого интернет<br> рекрутинга</h4>-->
        <p class="office-3-text"><?php echo $content ?></p>

    </div>
</div>

<script>
var url = window.location.protocol + '//' + window.location.host + '/';
$('#iframeText').empty();
$(".handler").change(function() {
    var path = $("input:radio:checked").val();
    var width =  $("#widthBanner").val();
    var height = $("#heightBanner").val();
    $('#iframeText').html('<iframe src="' + url  + 'admin/uploads/' + path +
        '" width="' + width + '" height="' + height +
        '" align="center"></iframe>');
    $('#iframeText').select();
})


$(document).ready(init);
function init(){
    $('#office-5-bannerMainDiv').hide();
}
function hideBannerDiv(){
    $('#office-5-bannerMainDiv').hide();
}
function showBannerDiv(){
    $('#office-5-bannerMainDiv').show();
    $('#iframeText').select();
}
</script>