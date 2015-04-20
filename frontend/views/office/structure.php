<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.min.js"); ?>
<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.js"); ?>
<?php Yii::app()->getClientScript()->registerCssFile("/css/jquery.bxslider.css"); ?>

<div class="main_wrapper">
   
<div class='structure_title'><?php echo BaseModule::t('rec', 'PERSONAL TEAM STRUCTURE') ?> (<?php echo BaseModule::t('rec', 'Total') ?>:&nbsp;<?php echo count($model->structureMembers) ?>)</div>
    
    <div class="slider_wrapper">
        <div class='segmentate module1' id="prev1"></div>
        <div class='segmentate module2'>
            <a style="background: none;" href="#">
            <div class="photo_wrap">
              <img class="img-circle" src="<?=(!$model->photo)? '/images/profilLogo.png': Yii::app()->params['upload.url'].'origin-'.$model->photo?>">
              <img class="right_arrow" src="/images/witharrow.png">
            </div>
            <div class="phototext_wrap">
                <p style="margin-left:0px;"><?=$model->first_name .' '.$model->last_name?></p>
            </div>
            </a>
        </div>
        
        <div class='segmentate module3'>
            <ul class="bxslider1">
<?php $penta = 1; ?> 
                <li>
                <?php foreach($model->structureMembers as $member) { ?>
                    <a style="background: none" href="">
                        <div class="photo_wrap">
                    <div>
                        <img class="img-circle" src="<?=(is_null($member->photo) || empty($member->photo))? '/images/profilLogo.png': Yii::app()->params['upload.url'].'origin-'.$member->photo?>">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div>
                        <div class="phototext_wrap"><p><?=$member->first_name.' '.$member->last_name?></p></div>
                        </div>
                    </a>
<?php if($penta == 5){ $penta = 0; echo '</li><li>&nbsp;';}?>    
<?php $penta ++; } ?>
               </li>
            </ul>
        </div>
        <div class='segmentate module4' id="next1" onclick="cl_del(this);"></div>
    </div>
<div style="height:100px;">&nbsp;</div>
<div class='structure_title'><?php echo BaseModule::t('rec', 'GLOBAL STRUCTURE OF BUSINESS CLUB') ?> (<?php echo BaseModule::t('rec', 'Total') ?>:&nbsp;<?php echo count($model->clubMembers) ?>)</div>
    <div class="test-green">
        <div class='segmentate module1' id="prev2"></div>
        <div class='segmentate module2'>
            <a style="background: none;" href="#">
            <div class="photo_wrap">
<!--              --><?php //CHtml::image('/admin/uploads/'.$model->photo,'',array('width'=>'100', 'height'=>'100')) ?>
              <img class="img-circle" src="<?=(!$model->photo)? '/images/profilLogo.png': Yii::app()->params['upload.url'].'origin-'.$model->photo?>?>" >
              <img class="right_arrow" src="/images/witharrow.png">
            </div>
            <div class="phototext_wrap">
                <p style="margin-left:0px;"><?=$model->first_name .' '.$model->last_name?></p>
            </div>
            </a>
        </div>
        <div class='segmentate module3'>
            <ul class="bxslider2">
<?php $penta = 1; ?> 
                <li>
                <?php if($isBusinessClub){
                foreach($model->clubMembers as $member) { ?>
                    <a style="background: none" href="">
                        <div class="photo_wrap">
                    <div>
                        <img class="img-circle" src="<?=(is_null($member->photo) || empty($member->photo))? '/images/profilLogo.png': Yii::app()->params['upload.url'].'origin-'.$member->photo?>">
                        <img class="right_arrow" src="/images/witharrow.png">
                    </div>
                        <div class="phototext_wrap"><p><?=$member->first_name.' '.$member->last_name?></p></div>
                        </div>
                    </a>
<?php if($penta == 5){ $penta = 0; echo '</li><li>&nbsp;';}?>    
<?php $penta ++; } }?>
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
    .main_wrapper{
        /*height: 200px;*/
        width: 1000px;
        padding-top: 5px;
        position: relative;
        padding-top: 135px;
    }
    .slider_wrapper{
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
    margin-left: 6px !important;
}
.phototext_wrap p {
    font-family: "Open Sans Condensed";
    font-size: 15px;
    color: #31414d;
    margin-left:-30px;width:130px;text-align:center;
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