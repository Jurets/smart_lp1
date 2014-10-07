<?php
    //выборка заголовков стат-страниц: вначале выбранного языка, затем того, что по умолчанию
    $titles = Information::getAllTitles();
?>
<div class="footer">
    <div id="footer">
        <div id="footerUL" > 
            <ul id="footerUL1">
                <li> <a href="/info/live" id="zagolovok"> <?php echo $titles['live'] ?> </a> </li>
                <li> <a href="/info/news"> <?php echo $titles['news'] ?> </a> </li>
                <li> <a href="/info/feedback"> <?php echo $titles['feedback'] ?></a> </li>
                <li> <a href="/info/youtube"> <?php echo $titles['youtube'] ?> </a> </li>
            </ul>

            <ul id="footerUL2">
                <li> <a href="/info/aboutus" id="zagolovok"> <?php echo $titles['aboutus'] ?> </a> </li>
                <li> <a href="/info/aboutproject"> <?php echo $titles['aboutproject'] ?> </a> </li>
                <li> <a href="/info/partners"> <?php echo $titles['partners'] ?> </a> </li>
                <li> <a href="/info/bankdetails"> <?php echo $titles['bankdetails'] ?> </a> </li>
            </ul>
            <ul id="footerUL3">
                <li> <a href="/info/service" id="zagolovok"> <?php echo $titles['service'] ?> </a> </li>
                <li> <a href="/info/financial"> <?php echo $titles['financial'] ?> </a> </li>
                <li> <a href="/info/bmachine"> <?php echo $titles['bmachine'] ?> </a> </li>
                <li> <a href="/info/advert"> <?php echo $titles['advert'] ?> </a> </li>
                <li> <a href="/info/perswww"> <?php echo $titles['perswww'] ?> </a> </li>
                <li> <a href="/info/sms"> <?php echo $titles['sms'] ?></a> </li>
            </ul>

            <ul id="footerUL4">
                <li> <a href="/info/rules" id="zagolovok"> <?php echo $titles['rules'] ?> </a> </li>
                <li> <a href="/info/agreement"> <?php echo $titles['agreement'] ?> </a> </li>
                <li> <a href="/info/community"> <?php echo $titles['community'] ?> </a> </li>
                <li> <a href="/info/antispam"> <?php echo $titles['antispam'] ?></a> </li>
            </ul>

            <ul id="footerUL5">
                <li> <a href="/info/cooperation" id="zagolovok"> <?php echo $titles['cooperation'] ?></a> </li>
                <li> <a href="/info/participants"> <?php echo $titles['participants'] ?> </a> </li>
                <li> <a href="/info/paysystems"> <?php echo $titles['paysystems'] ?></a> </li>
                <li> <a href="/info/exchangers"> <?php echo $titles['exchangers'] ?> </a> </li>
                <li> <a href="/info/platforms"> <?php echo $titles['platforms'] ?>  </a> </li>
                <li> <a href="/info/bereseller"> <?php echo $titles['bereseller'] ?> </a> </li>
            </ul>

            <ul id="footerUL6">
                <li> <a href="/info/support" id="zagolovok"> <?php echo $titles['support'] ?></a> </li>
                <li> <a href="/info/instructions"> <?php echo $titles['instructions'] ?> </a> </li>
                <li> <a href="/info/forum"> <?php echo $titles['forum'] ?> </a> </li>
                <li> <a href="/info/contactus"> <?php echo $titles['contactus'] ?></a> </li>
            </ul>

        </div>

        <div><a id="miniLogo"  href="/"></a></div>
        <p> <a   id="endText"  href="#">© 2014 <?php echo BaseModule::t('rec', 'World Charity System JMWS LLC POLAND') ?></a></p>

    </div>
<!--    <div id="footer-bark-bg"></div>-->
</div>

<script>
    $(function(){
        $('a.flag').attr('href', '#').css('opacity', 0.25);
    })

</script>