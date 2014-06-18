<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.min.js"); ?>
<?php Yii::app()->getClientScript()->registerScriptFile("/js/jquery.bxslider.js"); ?>
<?php Yii::app()->getClientScript()->registerCssFile("/css/jquery.bxslider.css"); ?>

<div class="test-red">
    
    <div class="test-green">
        <div class='test-box' id='prev1'></div>
        
        <div class='test-navy'>
        <ul class='bxslider1'>
            <li>
                <span>1</span>
                <span>1</span>
                <span>1</span>
                <span>1</span>
                <span>1</span>
            </li>
<li>
    <img src='/admin/uploads/vatslav_testovichek.jpeg'>
    <img src='/admin/uploads/vatslav_testovichek.jpeg'>
    <img src='/admin/uploads/vatslav_testovichek.jpeg'>
    <img src='/admin/uploads/vatslav_testovichek.jpeg'>
    <img src='/admin/uploads/vatslav_testovichek.jpeg'>
    <img src='/admin/uploads/vatslav_testovichek.jpeg'>
</li>
<li>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
</li>
<li>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
    <img src='/admin/uploads/tessa_testovichek.jpeg'>
</li>

        </ul>
        </div>
        <div class='test-box' id='next1' style='left:933px;'></div>
        </ul>
    </div>
 
</div>


<script>
$(document).ready(function(){
$('.bxslider1').bxSlider({
    prevSelector: '#prev1',
    nextSelector: '#next1',
    
});
});
</script>

<style>
    .test-red{
        height: 800px;
        border: 1px solid red;
    }
    .test-green{
        height: 100px;
        border: 1px solid green;
        margin: 135px 10px 0px 10px;
        position: relative;
    }
    .test-navy{
        height: 80px;
        border: 1px solid navy;
        margin: 10px 50px 10px 50px;
    }
    .test-box{
        width: 40px;
        height: 40px;
        border: 1px solid RGB(255,204,0);
        position: absolute;
        top: 30px;
        
    }
    .bx-wrapper img {
        display: inline;
    }
</style>