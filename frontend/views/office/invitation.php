<?php
/**
 * $this OfficeController
 * @var $youTubeUrlUniqueId
 * @var $downloadFile
 * @var $arrBannerFiles
 * @var $iFrameText
 */
//CHtml::image('/admin/uploads/'. $bannerPath['name']);
//CHtml::label('Высота: ','heightBanner');
//CHtml::numberField('heightBanner');
//
//CHtml::label('Ширина: ','widthBanner');
//CHtml::numberField('widthBanner');
//echo '<br>';
//bannerRadioButton
// echo CHtml::radioButton($bannerPath['name'],false,array('class'=>'bannerRadioButton'));
?>

<div id="office-5-content">
    <div id="office-5-bannerMainDiv">

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
                    echo CHtml::label('Ширина: ','widthBanner');
                    echo CHtml::numberField('widthBanner','150',array('class'=>'handler'));

                    echo CHtml::label('Высота: ','heightBanner');
                    echo CHtml::numberField('heightBanner','100',array('class'=>'handler'));

                    echo '<br>';
                    echo CHtml::textArea('iframeText',$iFrameText,array('readonly'=>true));

                    //echo CHtml::button('Скопировать',array('class'=>'settings-buttons'));

                ?>
                <input class="settings-buttons" type="button" value="Скопировать" onclick=""/>
                <input class="settings-buttons" type="button" value="Закрыть" onclick="hideBannerDiv();"/>
            </div>


    </div>
    <h2 class="h2ContentOffice5">ПРИГЛАШЕНИЕ</h2>
    <a href="<?php echo $downloadFile; ?>"><input type="button" name="btn"  class="btn-style-green1" value="СКАЧАТЬ" /></a>
    <a href="#"><input type="button" name="btn"  class="btn-style-green2" value="ИНТЕРНЕТ РЕКЛАМА" onclick="showBannerDiv();"/></a>


    <div id="office-5-post1">
        <div id="blogImg5">
        <?PHP
        $this->widget('ext.Yiitube', array('v' => $youTubeUrlUniqueId,'size'=>'mine'));
        ?>
        </div>
        <h4 class="office-5-miniZagolovok">Автоматизированная система непрямого интернет<br> рекрутинга</h4>
        <p class="office-3-text">Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад.Многие думают,Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад.Многие думают,  что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад.Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад.Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад.Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад.Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. </p>


    </div>
</div>

<script>
$(".handler").change(function() {
    var path = $("input:radio:checked").val();
    var width =  $("#widthBanner").val();
    var height = $("#heightBanner").val();
    $('#iframeText').html('<iframe src="admin/www/uploads/' + path +
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