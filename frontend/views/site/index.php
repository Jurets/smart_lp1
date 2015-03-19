<style type="text/css">

    .ap {
        color: #72806d;
        font-family: "Segoe UI",sans-serif;
        font-size: 85px;
        font-weight: normal;
        height: 20px;
    }
    
    /* ниже резерв */
    /*#ap3 {
        color: #72806d;
        font-family: "Segoe UI",sans-serif;
        font-size: 85px;
        font-weight: normal;
        height: 43px;
    }

    .slideText4 p:before {
        content: '“';
        color: #72806d;
        font-family: "Segoe UI",sans-serif;
        font-size: 85px;
        font-weight: normal;
    }*/

</style>

<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.min.js"); ?>
<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.js"); ?>
<?php Yii::app()->getClientScript()->registerCssFile("/css/jquery.bxslider.css"); ?>

<div id="content">
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
                    <img src="<?php echo UrlHelper::getImageUrl($slider['photo']) ?>" alt="" style="width:266px; height:326px; padding-top:15px; padding-left:25px;">
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
    var isFirst = 0;
    $('#sub4').live('click', function () {
        if (isFirst > 0) {
            $('#login').hide();
            $('.recovery-form').attr('id', 'login').show();
            return false;
        }
        isFirst++;

        var form = $('#login').clone(true, true);
        $('#login').hide();
        var text = form.find('#sub1-login').html('ВВЕДИТЕ EMAIL, </br> УКАЗАННЫЙ ПРИ РЕГИСТРАЦИИ :');
        var field = form.find('#UserLogin_username').attr('value', '').css('top', '50px').addClass('recovery-email');
        var message = form.find('#sub3-login').addClass('recovery-message').css({'top':100,'color':'red','text-align':'left'}).html('');
        var button = form.find('#btn-submit').attr({'value':'Отправить','id':'fake-button'}).css('top', '125px').addClass('recovery-send').prop('type', 'button');;
        
        $('.recovery-send').live('click', function(){
            var email = $('.recovery-form').find('.recovery-email').val();
            $.ajax('<?php echo Yii::app()->createAbsoluteUrl("user/recovery"); ?>',{
                type: 'POST',
                data:{
                    email: email
                },
                success: function (data, textStatus, jqXHR) {
                    data = $.parseJSON(data);
                    if(!data.success){
                        $('.recovery-message').html(data.message);
                        return false;
                    }
                    if(data.message){
                        $('.recovery-email').attr("disabled","disabled");
                        $('.recovery-send').die('click');
                        $('.recovery-message').html(data.message);
                    }
                        
                    },
                error: function (jqXHR, textStatus, errorThrown) {
                       console.log(jqXHR);
                    }
            });
        });
//        var button = form.find('#btn-submit').attr('value','Отправить').css('top', '105px').attr('id', 'recovery-send');
        form.empty().css('height', 169).addClass('recovery-form');
//        form.attr('id', 'recovery-form').empty().css('height', 149);
        form.append(text, field, message, button);
        $('#style-login').after(form);
        $('.in, .moveRight2').live('click', function () {
            $('.recovery-form').hide().attr('id', 'new-recovery-form');
        });
    });




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
            }
            
});
      timer = setTimeout(run, 60000);
  }
, 5000);
</script>


