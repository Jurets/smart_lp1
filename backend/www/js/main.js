$(document).ready(function(){
    $('#temp_key_link').click(function(){
        var username = $('#UserLogin_username').val();
        var password = $('#UserLogin_password').val();
        $.ajax({
            url:'/user/login/keygenerator',
            data:{'UserLogin[username]': username, 'UserLogin[password]': password},
            type:"POST",
            success:function( data, textStatus, jqXHR  ){
                $('#show-errors').empty();
                var response = $.parseJSON(data);
                if(response.success){
                    $('#show-errors').hide();
                    $('#temp_key_link').addClass('invisible');
                    $('#UserLogin_activekey').removeClass('invisible').prev().removeClass('invisible');
                } else {
                    for(var i in response.errorArr){
                        //$('#show-errors').append("<span>Errors:</span>").append("<br>").append("<span>"+ response.errorArr[i] +"</span>").append("<br>");
                        $('#show-errors').append("<span>"+ response.errorArr[i] +"</span>").append("<br>");
                    }
                    $('#show-errors').show();
                }
            }
        });
        return false;
    });
});
