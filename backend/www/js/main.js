$(document).ready(function(){
    $('#temp_key_link').click(function(){
        var email = $('#UserLogin_username').val();
        $.ajax({
            url:'/user/login/keygenerator',
            data:{'email':email},
            type:"POST",
            success:function( data, textStatus, jqXHR  ){
                $('#show-errors').empty();
                var response = $.parseJSON(data);
                if(response.success){
                    $('#temp_key_link').addClass('invisible');
                    $('#temp_key').removeClass('invisible').prev().removeClass('invisible');
                }else{
                    for(var i in response.errorArr){
                        
                        $('#show-errors').append("<span>Errors:</span>").append("<br>").append("<span>"+ response.errorArr[i] +"</span>").append("<br>");
                    }
                }
            }
        });
        return false;
    });
});
