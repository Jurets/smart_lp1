<style>
    .bx-prev {
    display: block;
    width: 34 !important;
    height: 189 !important;
}

.bx-next {
    display: block;
    width: 34;
    height: 189;
}
</style>

<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.min.js"); ?>
<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.js"); ?>
<?php Yii::app()->getClientScript()->registerCssFile("/css/jquery.bxslider.css"); ?>    
<div style="height:700px;">  
        
              <p class="office-2-text-1">СТРУКТУРА ЛИЧНОЙ КОМАНДЫ</p>
              <p class="office-2-text-2">ГЛОБАЛЬНАЯ СТРУКТУРА БИЗНЕСКЛУБА </p>
             
        
       <div id="office-2-structure1">
       
        <div class="prevGreen" href="" id="prev1"></div>
        <div class="nextGreen" href="" id="next1"></div>
        <!--<ul>
            <li><a class="profilLogo1" href="#"><p>Василий кузец1</p><img width="23" src="/images/witharrow.png" id="arrow-1-1"></a></li>
            <li><a class="profilLogo2" href="#"><p>Василий кузец2</p><img width="23" src="/images/witharrow.png" id="arrow-1-2"></a></li>
            <li><a class="profilLogo3" href="#"><p>Василий кузец3</p><img width="23" src="/images/witharrow.png" id="arrow-1-3"></a></li>
            <li><a class="profilLogo4" href="#"><p>Василий кузец4</p><img width="23" src="/images/witharrow.png" id="arrow-1-4"></a></li>
            <li><a class="profilLogo5" href="#"><p>Василий кузец5</p><img width="23" src="/images/witharrow.png" id="arrow-1-5"></a></li>
            <li><a class="profilLogo6" href="#"><p>Василий кузец6</p><img width="23" src="/images/witharrow.png" id="arrow-1-6"></a></li>
        </ul>-->
       
        <a class="profilLogo1" style="background: none;" href="#"><img class="img-circle" src="/admin/uploads/<?=$model->photo?>"><p><?=$model->first_name .' '.$model->last_name?></p><img width="23" src="/images/witharrow.png" id="arrow-1-1"></a>
            <ul class="bxslider1"><li>
                    <div style="height:100px;">
<?php $gexagon = 2; ?>
                <?php foreach($model->structureMembers as $member) { ?>
                
                    
                        <a class="profilLogo<?=$gexagon?>" style="background: none;" href="#"><img class="img-circle" src="/admin/uploads/<?=$member->photo?>"><p><?=$member->first_name .' '.$member->last_name?></p><img width="23" src="/images/witharrow.png" id="arrow-1-<?=$gexagon?>"></a>
                   
                
                <?php if($gexagon == 6) $gexagon = 1; ?>
                <?php $gexagon ++ ; ?>
                <?php } ?>
             </div>
                </li></ul>
       </div>     
        
        <div id="office-2-structure2">
       
        <a class="prevGreen2" href="#"></a>
        <a class="nextGreen2" href="#"></a>
        
        <a class="profilLogo1" href="#"><p>Василий кузец1</p><img width="23" src="/images/witharrow.png" id="arrow-1-1"></a>
        <a class="profilLogo2" href="#"><p>Василий кузец2</p><img width="23" src="/images/witharrow.png" id="arrow-1-2"></a>
        <a class="profilLogo3" href="#"><p>Василий кузец3</p><img width="23" src="/images/witharrow.png" id="arrow-1-3"></a>
        <a class="profilLogo4" href="#"><p>Василий кузец4</p><img width="23" src="/images/witharrow.png" id="arrow-1-4"></a>
        <a class="profilLogo5" href="#"><p>Василий кузец5</p><img width="23" src="/images/witharrow.png" id="arrow-1-5"></a>
        <a class="profilLogo6" href="#"><p>Василий кузец6</p><img width="23" src="/images/witharrow.png" id="arrow-1-6"></a>
        
        </div>
              
    </div>
<script>
$(document).ready(function(){
$('.bxslider1').bxSlider({
    prevSelector: '#prev1',
    nextSelector: '#next1',
    pager: false,
});
});
</script>