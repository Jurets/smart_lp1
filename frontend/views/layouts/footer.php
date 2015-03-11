<?php
    //выборка заголовков стат-страниц: вначале выбранного языка, затем того, что по умолчанию
    $titles = Information::getAllTitles();
?>
<div class="footer">
    <div id="footer">
        <div id="footerUL" > 
            <ul id="footerUL1">
                <li> <a href="/info/live" id="zagolovok"> <?php echo (isset($titles['live'])) ? $titles['live'] : '&nbsp;' ?> </a> </li>
                <?php if (isset($titles['news'])) {?>
                    <li> <a href="/info/news"> <?php echo $titles['news'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['feedback'])) {?>
                    <li> <a href="/info/feedback"> <?php echo $titles['feedback'] ?></a> </li>
                <?php } ?>
                <?php if (isset($titles['youtube'])) {?>
                    <li> <a href="/info/youtube"> <?php echo $titles['youtube'] ?> </a> </li>
                <?php } ?>
            </ul>

            <ul id="footerUL2">
                <li> <a href="/info/aboutus" id="zagolovok"> <?php echo (isset($titles['aboutus']) ? $titles['aboutus'] : '&nbsp;') ?> </a> </li>
                <?php if (isset($titles['aboutproject'])) {?>
                    <li> <a href="/info/aboutproject"> <?php echo $titles['aboutproject'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['partners'])) {?>
                    <li> <a href="/info/partners"> <?php echo $titles['partners'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['bankdetails'])) {?>
                    <li> <a href="/info/bankdetails"> <?php echo $titles['bankdetails'] ?> </a> </li>
                <?php } ?>
            </ul>
            <ul id="footerUL3">
                <li> <a href="/info/service" id="zagolovok"> <?php echo (isset($titles['service']) ? $titles['service'] : '&nbsp;') ?> </a> </li>
                <?php if (isset($titles['financial'])) {?>
                    <li> <a href="/info/financial"> <?php echo $titles['financial'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['bmachine'])) {?>
                    <li> <a href="/info/bmachine"> <?php echo $titles['bmachine'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['advert'])) {?>
                    <li> <a href="/info/advert"> <?php echo $titles['advert'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['perswww'])) {?>
                    <li> <a href="/info/perswww"> <?php echo $titles['perswww'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['sms'])) {?>
                    <li> <a href="/info/sms"> <?php echo $titles['sms'] ?></a> </li>
                <?php } ?>
            </ul>

            <ul id="footerUL4">
                <li> <a href="/info/rules" id="zagolovok"> <?php echo (isset($titles['rules']) ? $titles['rules'] : '&nbsp;') ?> </a> </li>
                <?php if (isset($titles['agreement'])) {?>
                    <li> <a href="/info/agreement"> <?php echo $titles['agreement'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['community'])) {?>
                    <li> <a href="/info/community"> <?php echo $titles['community'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['antispam'])) {?>
                    <li> <a href="/info/antispam"> <?php echo $titles['antispam'] ?></a> </li>
                <?php } ?>
            </ul>

            <ul id="footerUL5">
                <li> <a href="/info/cooperation" id="zagolovok"> <?php echo (isset($titles['cooperation']) ? $titles['cooperation'] : '&nbsp;') ?></a> </li>
                <?php if (isset($titles['participants'])) {?>
                    <li> <a href="/info/participants"> <?php echo $titles['participants'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['paysystems'])) {?>
                    <li> <a href="/info/paysystems"> <?php echo $titles['paysystems'] ?></a> </li>
                <?php } ?>
                <?php if (isset($titles['exchangers'])) {?>
                    <li> <a href="/info/exchangers"> <?php echo $titles['exchangers'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['platforms'])) {?>
                    <li> <a href="/info/platforms"> <?php echo $titles['platforms'] ?>  </a> </li>
                <?php } ?>
                <?php if (isset($titles['bereseller'])) {?>
                    <li> <a href="/info/bereseller"> <?php echo $titles['bereseller'] ?> </a> </li>
                <?php } ?>
            </ul>

            <ul id="footerUL6">
                <li> <a href="/info/support" id="zagolovok"> <?php echo (isset($titles['support']) ? $titles['support'] : '&nbsp;') ?></a> </li>
                <?php if (isset($titles['instructions'])) {?>
                    <li> <a href="/info/instructions"> <?php echo $titles['instructions'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['forum'])) {?>
                    <li> <a href="/info/forum"> <?php echo $titles['forum'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['contactus'])) {?>
                    <li> <a href="/info/contactus"> <?php echo $titles['contactus'] ?></a> </li>
                <?php } ?>
            </ul>

        </div>

        <div><a id="miniLogo"  href="/"></a></div>
        <p> <a   id="endText"  href="#">© 2014 <?php echo BaseModule::t('rec', 'World Charity System JMWS LLC POLAND') ?></a></p>

    </div>
    <div id="footer-bark-bg"></div>
</div>

<script>
    $(function(){
        $('a.flag').attr('href', '#').css('opacity', 0.25);
    })

</script>