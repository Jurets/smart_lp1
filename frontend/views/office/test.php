<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.min.js"); ?>
<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.js"); ?>
<?php Yii::app()->getClientScript()->registerCssFile("/css/jquery.bxslider.css"); ?>

<div class="test-red">
   
<div class='structure_title'>СТРУКТУРА ЛИЧНОЙ КОМАНДЫ</div>
    
    <div class="test-green">
        <div class='segmentate module1' id="prev1"></div>
        <div class='segmentate module2'>
            <a style="background: none;" href="#">
            <div class="photo_wrap">
              <img class="img-circle" src="/admin/uploads/<?=$model->photo?>">
              <img class="right_arrow" src="/images/witharrow.png">
            </div>
            <div class="phototext_wrap">
                <p><?=$model->first_name .' '.$model->last_name?></p>
            </div>
            </a>
        </div>
        
        <div class='segmentate module3'>
            <ul class="bxslider1">
                <li>
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div>  
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                </li>
                <li>
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                </li>
            </ul>
        </div>
        <div class='segmentate module4' id="next1" onclick="cl_del(this);"></div>
    </div>
<div style="height:100px;">&nbsp;</div>
<div class='structure_title'>ГЛОБАЛЬНАЯ СТРУКТУРА БИЗНЕСКЛУБА</div>
    <div class="test-green">
        <div class='segmentate module1' id="prev2"></div>
        <div class='segmentate module2'>
            <a style="background: none;" href="#">
            <div class="photo_wrap">
              <img class="img-circle" src="/admin/uploads/<?=$model->photo?>">
              <img class="right_arrow" src="/images/witharrow.png">
            </div>
            <div class="phototext_wrap">
                <p><?=$model->first_name .' '.$model->last_name?></p>
            </div>
            </a>
        </div>
        
        <div class='segmentate module3'>
            <ul class="bxslider2">
                <li>
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div>  
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                    <div class="photo_wrap">
                        <img class="img-circle" src="/admin/uploads/tessa_testovichek.jpeg">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div> 
                </li>
                <li>
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                    <img src="/admin/uploads/volk_zubastiuy.jpeg">
                </li>
            </ul>
        </div>
        <div class='segmentate module4' id="next2"></div>
    </div>
    
</div>


<script>
$(document).ready(function(){ 
    
$('.bxslider1').bxSlider({
    prevSelector: '#prev1',
    nextSelector: '#next1',
    prevText: '&nbsp;',
    nextText: '&nbsp;',
    pager: false,
});

$('.bxslider2').bxSlider({
    prevSelector: '#prev2',
    nextSelector: '#next2',
    prevText: '&nbsp;',
    nextText: '&nbsp;',
    pager: false,
});

});
</script>

<style>
    .test-red{
        /*height: 200px;*/
        width: 1000px;
        padding-top: 5px;
        position: relative;
        padding-top: 135px;
    }
    .test-green{
        margin: 0px 0px 100px 0px;
        position: relative;
    }
    .segmentate {
        float: left;
        /*border: 1px solid black;*/
        height: 189px;
        background-color: #D0D0D0;
    }
    .module1{
        width:33px;
        background: url(../images/prevGreen.png);
    }
    .module2{
        width:140px;
    }
    .module3{
        width:793px;
        background: #D0D0D0;
    }
    .module4{
        width:33px;
        background: url(../images/nextGreen.png);
    }
    
    .bx-wrapper img {
        display: inline;
    }
    
    .bx-wrapper .bx-prev {
	/*left: 0px;
	background: url(/img/controls.png) no-repeat 0 -32px;*/
}

.bx-wrapper .bx-next {
	/*right: 0px;
	background: url(/img/controls.png) no-repeat -43px -32px;*/
}
.phototext_wrap {
    margin-left: 6px; /* !important;*/
}
.phototext_wrap p {
    font-family: "Open Sans Condensed";
    font-size: 15px;
    color: #31414d;
}
.photo_wrap {
    width: 130px;
    margin: 47px 0px 0px 27px;
    float: left;
}

.right_arrow {
    margin: 2px 0px 0px 20px;
}
.bx-wrapper .bx-viewport {
    border: none;
    background: none;
}
.structure_title {
    color: #007E97;
    font-size: 25px;
    margin-bottom: 5px;
    margin-top: 20px;
}
.bx-prev, .bx-next {
    display: block;
    width: 34px;
    height: 189px;
}
</style>