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
                    <li style="padding-bottom:5px;"> <a href="/info/aboutproject" id="footerUL1ahref"> <?php echo $titles['aboutproject'] ?> </a> </li>
                <?php } ?>
                
                <?php if (isset($titles['partners'])) {?>
                    <li> <a href="/info/partners" id="footerUL1ahref"> <?php echo $titles['partners'] ?> </a> </li>
                <?php } ?>
                
                <?php if (isset($titles['contactus'])) {?>
                    <li> <a href="/info/contactus" id="footerUL1ahref"> <?php echo $titles['contactus'] ?></a> </li>
                <?php } ?>
                
            </ul>
            
            
            <ul id="footerUL3" style="margin-left: -130px;">
            
                <li> <a id="zagolovok" style="cursor:default;"> <?php echo (isset($titles['service']) ? $titles['service'] : 'Инструменты') ?> </a> </li>
                
                <?php if (isset($titles['bmachine'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/bmachine" id="footerUL1ahref"> <?php echo $titles['bmachine'] ?> </a> </li>
                <?php } ?>
                
                <?php if (isset($titles['scripts'])) {?>
                    <li> <a href="/info/scripts" id="footerUL1ahref"> <?php echo $titles['scripts'] ?> </a> </li>
                <?php } ?>
                
               
               
                
            </ul>

            <ul id="footerUL4" style="margin-left: -55px;">
                <li> <a id="zagolovok" style="cursor:default;"><?php echo (isset($titles['rules']) ? $titles['rules'] : '&nbsp;') ?> </a> </li>
                <?php if (isset($titles['possibilities'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/possibilities" id="footerUL1ahref"> <?php echo $titles['possibilities'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['rulespo'])) {?>
                    <li> <a href="/info/rules" id="footerUL1ahref"> <?php echo $titles['rulespo'] ?> </a> </li>
                <?php } ?>
               
            </ul>

            <ul id="footerUL5" style="margin-left: -30px;">
                <li> <a id="zagolovok" style="cursor:default;"><?php echo (isset($titles['cooperation']) ? $titles['cooperation'] : '&nbsp;') ?></a> </li>
                <?php if (isset($titles['changes'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/changes" id="footerUL1ahref"> <?php echo $titles['changes'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['paysystem'])) {?>
                    <li> <a href="https://perfectmoney.is" id="footerUL1ahref" target="_blank"> <?php echo $titles['paysystem'] ?></a> </li>
                <?php } ?>

            </ul>

            <ul id="footerUL6" style="margin-left: 39px;">
                <li> <a id="zagolovok" style="cursor:default;"><?php echo (isset($titles['support']) ? $titles['support'] : '&nbsp;') ?></a> </li>
                <?php if (isset($titles['instructions'])) {?>
                    <li style="padding-bottom:5px;"> <a href="/info/instructions" id="footerUL1ahref"> <?php echo $titles['instructions'] ?> </a> </li>
                <?php } ?>
                <?php if (isset($titles['questions'])) {?>
                    <li> <a href="/info/questions" id="footerUL1ahref"> <?php echo $titles['questions'] ?></a> </li>
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