
jQuery(document).ready(function() {

    $('.page-container form').submit(function(){
        var username = $(this).find('.username').val();
        var truename = $(this).find('.truename').val();
        var phone = $(this).find('.phone').val();
        var role = $(this).find('.select option:selected').val();
        var p_reg = /^0{0,1}(13[0-9]|15[0-9]|153|156|18[0-9])[0-9]{8}$/;//电话验证
        if (role == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '2px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false;
        }else if(username == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '47px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false;
        }else if(truename == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '116px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.truename').focus();
            });
            return false;
        }else if (phone == '' || !p_reg.test(phone)) {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '185px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.phone').focus();
            });
            return false;            
        }else{
             $.ajax({
                url: 'http://localhost:8080/ecjtuexam/index.php/losepd/checkInfo',
                type: 'POST',
                dataType: 'json',
                data: { 
                        user_role:role,
                        user_name:username,
                        user_truename:truename,
                        user_phone:phone,
                    },
                success:function(data)
                {
                    if(data.status==1)
                    {
                        alert('密码 '+data.pass);//告知密码
                    }else if(data.status==0){
                        alert(data.msg);
                    }
                },
                error:function(error)
                {
                    console.log(error.responseText);
                    //alert("后台出了点小问题，稍后再来吧...");
                },
         });            
        }
    });

    $('.page-container form .username, .page-container form .truename,.page-container form .phone').keyup(function(){
        $(this).parent().find('.error').fadeOut('fast');
    });

});
