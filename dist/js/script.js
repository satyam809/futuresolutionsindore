$(document).ready(function () {
    // login
    //$('#submit_form').parsley();
    $('#submit_form').on('submit', function (e) {
        e.preventDefault();

        //alert($('#submit_form').serialize());
        //console.log($('#submit_form').serialize());
        //$('#response').html($('#submit_form').serialize());
        $.ajax({
            url: "http://localhost/codeigniter_project/futuresolution/admin/check_login",
            method: "POST",
            dataType: "JSON",
            data: new FormData(this),
            contentType: false,
            //cache:false,  
            processData: false,
            success: function (data) {
                if (data.error) {
                    if (data.username_error != '') {
                        $('#username_error').html(data.username_error);
                    }
                    else {
                        $('#username_error').html('');
                    }
                    if (data.password_error != '') {
                        $('#password_error').html(data.password_error);
                    }
                    else {
                        $('#password_error').html('');
                    }
                    
                }
                if (data.success) {
                    //On success redirect.  
                    window.location.replace(data.success);
                }
                if(data.message){
                    $('#message_error').html(data.message);
                    $('#message_error').css('display','block');
                }
            }

        });
    //
});
// logout
$(document).on('click', '#logout', function (e) {

    e.preventDefault();//console.log("test");
    $.ajax({
        url: "http://localhost/codeigniter_project/futuresolution/admin/logout",
        method: "POST",
        dataType: "json",
        success: function (data) {//console.log(data);
            if (data.status === true) {
                window.location.replace("http://localhost/codeigniter_project/futuresolution/admin");
            }
        }
    });
});
   
});