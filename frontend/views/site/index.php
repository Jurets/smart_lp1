<?php Yii::app()->getClientScript()->registerscriptFile("/js/jquery.bxslider.min.js"); ?>
<div id="content">
    <div id="videoBG"></div>
    <div>
        <a id="logo" href="index.html"> </a>
    </div>

    <iframe class="video"  src="<?php echo $model->videolink; ?>" frameborder="0" allowfullscreen></iframe>
    <a id="greenButton" href="#">            ПРИСОЕДИНИТЬСЯ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> </span> </a>

</div>

<!--<div id="white">
    <a href="#"><div id="prev"></div></a>
    <a href="#"><div id="next"></div></a>

    <div id="photo"><div id="photoIn"></div></div>

    <ul id="slideText">
        <li class="slideText1">ЛИДЕРЫ </li>
        <li class="slideText2">ОНИ ЗАРАБАТЫВАЮТ БОЛЬШЕ 1000 $ В ДЕНЬ! </li>
        <li class="slideText3">ВАРЛАМ ГРИГОРЯН </li>
        <li class="slideText4">Я НИКОГДА В ЖИЗНИ НЕ МОГ ПОДУМАТЬ, ЧТО ЧЕРЕЗ 10 МЕСЯЦЕВ <br> НАХОДЯСЬ В ОРГАНО ГОЛД, Я БУДУ СТОЯТЬ НА СЦЕНЕ В ЛАС ВЕГАСЕ<br> И 20.000 ЧЕЛОВЕК БУДУТ МНЕ АПЛОДИРОВАТЬ. И ЭТО ТОЛЬКО<br> НАЧАЛО.<br> ЭТО ЛЕГКО, ЭТО ПРОСТО, ЭТО КОФЕ!  </li>
        <div id="ap">“</div>
        <div id="ap2">“</div>
    </ul>

    <ul id="slide1">
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li></li> </a>
        <a href="#"> <li class="slide1B"></li> </a>
        <a href="#"> <li></li> </a>
    </ul>
</div> -->

<div id="white">
    
    <ul class="bxslider">
        <?php foreach($model->sliderlist as $slider) { ?>
        <li>
            <img src="<?php echo '/admin/uploads/'.'resized-'.$slider['photo'] ?>" alt="портрет" />
        </li>
        <?php } ?>
    </ul>
</div>

<div id="darkBG">
    <div id="infoBlok1">
        <p class="reg1">ЗАРЕГИСТРИРОВАНО УЧАСТНИКОВ</p>
        <div id="numberDecor1"><p>00 652 427</p> <div id="test1"></div></div>
        <p class="regB">ТЕКУЩИЕ РЕГИСТРАЦИИ</p>    
        <ul class="li">
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
            <li id="tailand" >12:45 UTC Sergey Menshov</li>
        </ul>
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
