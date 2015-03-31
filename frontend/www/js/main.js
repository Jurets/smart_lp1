$(document).ready(function () {
    var isFirst = 0;
    $('#sub4').live('click', function () {
        if (isFirst > 0) {
            $('#login').hide();
            $('.recovery-form').attr('id', 'login').show();
            return false;
        }
        isFirst++;

        var form = $('#login').clone(true, true);
        $('#login').hide();
        var text = form.find('#sub1-login').html('ВВЕДИТЕ EMAIL, </br> УКАЗАННЫЙ ПРИ РЕГИСТРАЦИИ :');
        var field = form.find('#UserLogin_username').attr('value', '').css('top', '50px').addClass('recovery-email');
        var message = form.find('#sub3-login').addClass('recovery-message').css({'top':100,'color':'red','text-align':'left'}).html('');
        var button = form.find('#btn-submit').attr({'value':'Отправить','id':'fake-button'}).css('top', '125px').addClass('recovery-send').prop('type', 'button');;
        
        $('.recovery-send').live('click', function(){
            var email = $('.recovery-form').find('.recovery-email').val();
            //$.ajax('<?php echo Yii::app()->createAbsoluteUrl("user/recovery"); ?>',{
            $.ajax('user/recovery',{
                type: 'POST',
                data:{
                    email: email
                },
                success: function (data, textStatus, jqXHR) {
                    data = $.parseJSON(data);
                    if(!data.success){
                        $('.recovery-message').html(data.message);
                        return false;
                    }
                    if(data.message){
                        $('.recovery-email').attr("disabled","disabled");
                        $('.recovery-send').die('click');
                        $('.recovery-message').html(data.message);
                    }
                        
                    },
                error: function (jqXHR, textStatus, errorThrown) {
                       console.log(jqXHR);
                    }
            });
        });
//        var button = form.find('#btn-submit').attr('value','Отправить').css('top', '105px').attr('id', 'recovery-send');
        form.empty().css('height', 169).addClass('recovery-form');
//        form.attr('id', 'recovery-form').empty().css('height', 149);
        form.append(text, field, message, button);
        $('#style-login').after(form);
        $('.in, .moveRight2').live('click', function () {
            $('.recovery-form').hide().attr('id', 'new-recovery-form');
        });
    });
});
