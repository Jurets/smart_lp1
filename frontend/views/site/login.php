<?php
/**
*  Частичное представление для авторизованного входа
*/
?>
<!--<div id="login" style="left: 1208px; top: 40px;font-family: 'Open Sans Condensed','sans-serif';">-->
<div id="login" style="font-family: 'Open Sans Condensed','sans-serif';">
    <p class="sub1">ИМЯ ПОЛЬЗОВАТЕЛЯ:</p>
    <input class="textbox1" type="text"> 
    <p class="sub2">ПАРОЛЬ:</p>
    <input class="textbox2" type="text">
    <a href="#" id="captcha"></a>
    <a href="#" id="refresh" > </a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <p class="sub3">ВВЕДИТЕ КОД С КАРТИНКИ:</p> 
    <input class="textbox3" type="text"> 
    <a href="#"><input type="button" name="btn"  class="btn-style" value="ВОЙТИ" ></a>
    <a href="#" id="sub4">ЗАБЫЛИ ПАРОЛЬ?</a>
</div>

<script>
    $('#login').hide();
    $(document).ready(function() {
        $('.open-login, .in').on("click",function (){
            if($('#login').css('display')!='none'){
                $('#login').hide()
            } else {
                $('#login').show();
            }
        })
        return false;
    });
</script>