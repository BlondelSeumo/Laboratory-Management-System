(function($){
        
    "use strict";

    //active
    $('#profile').addClass('active');
    
    //remove the general validation and assign a new validation for the profile form
    $('#profile_form').removeData('validator');
    $('#profile_form').validate({
        rules:{
            name:{
                required:true,
            },
            email:{
                required:true,
                email:true
            },
            password:{
                required:function(){
                    return $('#password_confirmation').val()!="";
                },
            },
            password_confirmation:{
                required:function(){
                    return $('#password').val()!="";
                },
                equalTo:"#password"
            }
        },
        messages:{
            password_confirmation:{
                equalTo:trans("Password confirmation does not match password")
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });

})(jQuery);
