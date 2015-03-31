<style type="text/css">

    .ap {
        color: #72806d;
        font-family: "Segoe UI",sans-serif;
        font-size: 85px;
        font-weight: normal;
        height: 20px;
    }

#logo{
    width: 398px;
    height: 110px;
    background-image: url(http://newuser.justmoney.pro/images/logo.png);
    background-repeat: no-repeat;
    position: absolute;
    top: 27px;
    left: 15px;
}

#infoBlok1{
    text-align: left;
    background-image: url(../images/infoblok3.png);
    width: 303px;
    height: 314px;
    top: -27px;
    left: 0px;
    border-radius: 5px;
    position: absolute;
    text-align: left;
}

#infoBlok2 {
    text-align: left;
    background-image: url(../images/infoblok3.png);
    width: 303px;
    height: 314px;
	top: -27px;
 	left: 349px;
  	border-radius: 5px;
  	position: absolute;
}

#infoBlok3{
    text-align: left;
    background-image: url(../images/infoblok3.png);
    width: 303px;
    height: 314px;
    top: -27px;
    left: 697px;
    border-radius: 5px;
    position: absolute;
}

#darkBGG {
  top: 1392px;
  width: 100%;
  height: 275px;
  background-color:#161616;
  position: absolute;
  z-index: 5;
}

.sociconb1 {display: block; position: relative; width: 40px; height: 40px;
	background: url(../images/s/vk7.png) no-repeat;}
.sociconb1 span {position: absolute; top: 0; left: 0; bottom: 0; right: 0;
	background: url(../images/s/vk7.png) no-repeat; background-position: 0 -40px; opacity: 0; -webkit-transition: opacity 0.5s; -moz-transition: opacity 0.5s -o-transition: opacity 0.5s;
}
.sociconb1:hover span {opacity: 1;
}

.sociconb2 {display: block; position: relative; width: 40px; height: 40px; margin:-40px 0 0 45px;
	background: url(../images/s/fb7.png) no-repeat;}
.sociconb2 span {position: absolute; top: 0; left: 0px; bottom: 0; right: 0;
	background: url(../images/s/fb7.png) no-repeat; background-position: 0 -40px; opacity: 0; -webkit-transition: opacity 0.5s; -moz-transition: opacity 0.5s -o-transition: opacity 0.5s;
}
.sociconb2:hover span {opacity: 1;
}

.sociconb3 {display: block; position: relative; width: 40px; height: 40px; margin:-40px 0 0 90px;
	background: url(../images/s/ok7.png) no-repeat;}
.sociconb3 span {position: absolute; top: 0; left: 0px; bottom: 0; right: 0;
	background: url(../images/s/ok7.png) no-repeat; background-position: 0 -40px; opacity: 0; -webkit-transition: opacity 0.5s; -moz-transition: opacity 0.5s -o-transition: opacity 0.5s;
}
.sociconb3:hover span {opacity: 1;
}
  
#content{
    width: 100% ;
    height: 872px; 
    position: relative;
    top: -7px; }

#endText {
  left: -94px;
  top: 198px;

}

#nav li a{
    text-decoration: none;
    font-size: 14px;
    color: #ccc;
    font-weight: 900;
}

#nav li a:hover {
    color: #fff; /* Цвет ссылки */ 
   } 

.navli2 a{
    text-decoration: none;
    font-size: 14px;
    color: #color:#FC0;;
    font-weight: 900;
}

.navli2 a:hover {
    color: #fff; /* Цвет ссылки */ 
	
   } 
   
   #fake-button {
       top: 125px;
   }

   
   .recovery-sub {
       color: #879092 !important;
       font-size: 14px;
       font-weight: bold;
       margin-top: 12px;
   }
   /*#UserLogin_username {
       margin-top: 5px;
       top: 50px !important;
   }*/
   
</style>
<link rel="icon" href="http://newuser.justmoney.pro/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://newuser.justmoney.pro/favicon.ico" type="image/x-icon">

<?php 
    Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.min.js");
    Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.js");
    Yii::app()->getClientScript()->registerCssFile("/css/jquery.bxslider.css"); 
    
    Yii::app()->getClientScript()->registerScriptFile("/js/main.js");
?>

<div id="content">
<div style=" position:absolute; z-index:99; width: 130px; height: 40px; left:893px; top: 1855px; border-radius: 5px;">
	<a href="http://vk.com/justmoney" class="sociconb1" target="_blank"><span></span></a>
	<a href="http://facebook.com/justmoneypro" class="sociconb2" target="_blank"><span></span></a>
    <a href="http://ok.ru/justmoney" class="sociconb3" target="_blank"><span></span></a>
</div>
    <div id="videoBG"></div>
    <div>
        <a id="logo" href="<?php echo Yii::app()->createAbsoluteUrl(''); ?>"> </a>
    </div>

    <iframe class="video"  src="<?php echo $model->videolink; ?>" frameborder="0" allowfullscreen></iframe>
    <a id="greenButton" href="<?php echo Yii::app()->createAbsoluteUrl('register'); ?>"><?php echo BaseModule::t('common', 'JOIN') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> </span> </a>

</div>

<div id="white">
    
    <ul class="bxslider">
        <?php if(isset($model->sliderlist)){ ?>
        <?php foreach($model->sliderlist as $slider) { ?>
        <li>
            <div style="height: 400px; background: #eeeeee;">
                <div id="photo">
                    <img src="<?php echo UrlHelper::getImageUrl($slider['photo']) ?>" alt="" style="width:261px; height:323px; padding-top:17px; padding-left:28px;">
                </div>
                <ul id="slideText">
                    <li class="slideText1"><?php echo BaseModule::t('common', 'LEADERS') ?></li>
                    <li class="slideText2"><?php echo $model->title ?></li>
                    <li class="slideText3"><?php echo $slider['leader']; ?></li>
                    <li class="slideText4">
                        <div class="ap" style="float: left; margin-right: 10px;">“</div>
                        <div><?php echo $slider['descriptio']; ?></div>
                        <div class="ap" style="float: right; margin-left: 10px;">“</div>
                    </li>
                </ul>
            </div>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>
   
</div>

<div id="darkBG">
    <div id="usrcontour">
        <?php 
        $this->widget('application.widgets.UserContour.UserContour',
            array( 'params' => array(
            'cssID' => 1,
            'head' => BaseModule::t('common', 'REGISTERED MEMBERS'),
            'title'=> BaseModule::t('common', 'CURRENT REGISTRATION'),
        ))); 
        $this->widget('application.widgets.UserContour.UserContour',
            array( 'params' => array(
                'cssID' => 2,
                'head' => BaseModule::t('common', 'FEE PAID'),
                'title'=> BaseModule::t('common', 'CURRENT PAYMENTS'),
        ))); 
        $this->widget('application.widgets.UserContour.UserContour',
            array( 'params' => array(
                'cssID' => 3,
                'head' => BaseModule::t('common', 'GIVEN ON CHARITY'),
                'title'=> BaseModule::t('common', 'CURRENT FEES'),
        ))); 
        ?>
    </div>
</div>


<script>
$(document).ready(function () {
    // слайдер лидеров
    $('.bxslider').bxSlider({
        //prevSelector: '#prevS',
        //nextSelector: '#nextS'
    });
});

// --------- обновление счётчиков / update counters
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
            }

        });
        timer = setTimeout(run, 60000);
    }
    , 5000);
</script>


