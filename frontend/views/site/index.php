<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.min.js"); ?>
<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.js"); ?>
<?php Yii::app()->getClientScript()->registerCssFile("/css/jquery.bxslider.css"); ?>

<div id="content">
    <div id="videoBG"></div>
    <div>
        <a id="logo" href="index.html"> </a>
    </div>

    <iframe class="video"  src="<?php echo $model->videolink; ?>" frameborder="0" allowfullscreen></iframe>
    <a id="greenButton" href="<?php echo Yii::app()->createAbsoluteUrl('register'); ?>">            ПРИСОЕДИНИТЬСЯ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> </span> </a>

</div>

<div id="white">
    
    <ul class="bxslider">
        <?php if(isset($model->sliderlist)){ ?>
        <?php foreach($model->sliderlist as $slider) { ?>
        <li>
            <div style="height: 400px; background: #eeeeee;">
                <div id="photo">
                    <img src="<?php echo '/admin/uploads/'./*'resized-'.*/$slider['photo'] ?>" alt="" style="width:266px; height:326px; padding-top:15px; padding-left:25px;">
                </div>
                <ul id="slideText">
                    <li class="slideText1">ЛИДЕРЫ</li>
                    <li class="slideText2"><?php echo $model->title ?></li>
                    <li class="slideText3"><?php echo $slider['leader']; ?></li>
                    <li class="slideText4"><?php echo $slider['descriptio']; ?></li>
                    <div id="ap">“</div>
                    <div id="ap2">“</div>
                </ul>
            </div>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>
   
</div>

<div id="darkBG">
     
<div id="usrcontour">
<?php $this->widget('application.widgets.UserContour.UserContour',
        array( 'params' => array( 
        'cssID' => 1,
        'head' => 'ЗАРЕГИСТРИРОВАНО УЧАСТНИКОВ',
        'title'=> 'ТЕКУЩИЕ РЕГИСТРАЦИИ',
    ))); ?>
</div>
    <div id="infoBlok2">
        <p class="reg2">ВЫПЛАЧЕНО КОМИССИОННЫХ</p>
        <div id="numberDecor2"><p>$00 652 427</p> <div id="test2"></div></div>
        <p class="regB">ТЕКУЩИЕ ВЫПЛАТЫ</p>    
        <ul class="li">
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
        </ul>

    </div>

    <div id="infoBlok3">
        <p class="reg3">ОТДАНО НА БЛАГОТВОРИТЕЛЬНОСТЬ</p>
        <div id="numberDecor3"><p>$00 652 427</p> <div id="test3"></div></div>
        <p class="regB">ТЕКУЩИЕ ОТЧИСЛЕНИЯ</p>    
        <ul class="li">
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
        </ul>
    </div>

</div>


<script>
$(document).ready(function(){
$('.bxslider').bxSlider({
//    prevSelector: '#prevS',
//    nextSelector: '#nextS'
});
});
</script>

<script>
var usrContour = setTimeout(
  function run(){
      $.ajax({
        type: "POST",
            url: "<?php echo $this->createAbsoluteUrl('site/usrcontour')?>",
            dataType: 'html',
            success: function(res){
                $('#usrcontour').html(res);
            },
            error: function(){
                //alert("ERROR");
                console.log('Счётчики: Ошибка при посылке AJAX-запроса');
            },
            
});
      timer = setTimeout(run, 60000);
  }
, 5000);
</script>


