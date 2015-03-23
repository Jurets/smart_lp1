<?php
    //выборка заголовков стат-страниц: вначале выбранного языка, затем того, что по умолчанию
    $titles = Information::getAllTitles();
?>
<div class="footer">
    <div id="footer">
        <div id="footerUL" > 
           <ul id="footerUL1">
            </ul>

            <ul id="footerUL2" style="margin-left: -144px;">
                <li> <a id="zagolovok" style="cursor:default;"><?php echo (isset($titles['aboutus']) ? $titles['aboutus'] : '&nbsp;') ?> </a></li>
                
                <?php if (isset($titles['aboutproject'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/aboutproject"> <?php echo $titles['aboutproject'] ?> </a> </li>
                <?php } ?>
                
                <?php if (isset($titles['partners'])) {?>
                    <li> <a href="/info/partners"> <?php echo $titles['partners'] ?> </a> </li>
                <?php } ?>
                
                <?php if (isset($titles['bankdetails'])) {?>
                    <li> <a href="/info/bankdetails"> <?php echo $titles['bankdetails'] ?> </a> </li>
                <?php } ?> 
                
            </ul>
            
            
            <ul id="footerUL3" style="margin-left: -120px;">
            
                <li> <a id="zagolovok" style="cursor:default;"> <?php echo (isset($titles['service']) ? $titles['service'] : 'Сервис') ?> </a> </li>
                
                <?php if (isset($titles['financial'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/financial"> <?php echo $titles['financial'] ?> </a> </li>
                <?php } ?>
                
                <?php if (isset($titles['bmachine'])) {?>
                    <li> <a href="/info/bmachine"> <?php echo $titles['bmachine'] ?> </a> </li>
                <?php } ?>
                
               
               
                
            </ul>

            <ul id="footerUL4" style="margin-left: -70px;">
                <li> <a id="zagolovok" style="cursor:default;"><?php echo (isset($titles['rules']) ? $titles['rules'] : '&nbsp;') ?> </a> </li>
                <?php if (isset($titles['agreement'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/agreement"> <?php echo $titles['agreement'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['community'])) {?>
                    <li> <a href="/info/community"> <?php echo $titles['community'] ?> </a> </li>
                <?php } ?>
               
            </ul>

            <ul id="footerUL5" style="margin-left: -30px;">
                <li> <a id="zagolovok" style="cursor:default;"><?php echo (isset($titles['cooperation']) ? $titles['cooperation'] : '&nbsp;') ?></a> </li>
                <?php if (isset($titles['participants'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/participants"> <?php echo $titles['participants'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['paysystems'])) {?>
                    <li> <a href="/info/paysystems"> <?php echo $titles['paysystems'] ?></a> </li>
                <?php } ?>

            </ul>

            <ul id="footerUL6" style="margin-left: 39px;">
                <li> <a id="zagolovok" style="cursor:default;"><?php echo (isset($titles['support']) ? $titles['support'] : '&nbsp;') ?></a> </li>
                <?php if (isset($titles['instructions'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/instructions"> <?php echo $titles['instructions'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['contactus'])) {?>
                    <li> <a href="/info/contactus"> <?php echo $titles['contactus'] ?></a> </li>
                <?php } ?>
            </ul>

        </div>

        <div><a id="miniLogo" href="/"></a></div>
        <p> <a id="endText" href="/">© 2014—2015&nbsp&nbsp<?php echo BaseModule::t('rec', 'JUSTMONEY WORLDSYSTEM') ?> </a></p>
    </div>
        
    <div id="footer-bark-bg">

   </div>
</div>


<script>
    $(function(){
        $('a.flag').attr('href', '#').css('opacity', 0.25);
    })

</script>