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
   
    <h2 class="h2ContentOffice5"><?php echo BaseModule::t('common', 'INVITATION'); ?></h2>
    <a href="<?php echo $downloadFile; ?>"><input type="button" name="btn"  class="btn-style-green1" value="<?php echo BaseModule::t('rec', 'DOWNLOAD') ?>" /></a>
 <!--   <a href="#"><input type="button" name="btn"  class="btn-style-green2" value="<?php echo BaseModule::t('rec', 'INTERNET ADVERTISING') ?>" onclick="showBannerDiv();"/></a>-->


    <div id="office-5-post1">
        <div id="blogImg5">
        <?PHP
        $this->widget('ext.Yiitube', array('v' => $youTubeUrlUniqueId,'size'=>'mine'));
        ?>
        </div>
  
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
    $('#iframeText').html('<iframe src="' + url  + 'superjust/uploads/' + path +
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