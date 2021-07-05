(function($){

    "use strict";

    $.widget.bridge('uibutton', $.ui.button);

    //initialize select2
    $('.select2').select2({
      width:"100%"
    });

    //datepicker
    var date=new Date();
    var current_year=date.getFullYear();
    $('.datepicker').datepicker({
      dateFormat:"dd-mm-yy",
      changeYear: true,
      changeMonth: true,
      yearRange:"1900:"+current_year

    });

    $('form').each(function() {  // attach to all form elements on page
      $(this).validate({       // initialize plugin on each form
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
    });

    
    $(window).on('load',function() {
        $('.preloader').hide();
        $('.loader').hide();
    });

})(jQuery);


//url
function url(url='')
{
  var base_url=location.origin;

  return base_url+'/'+url;
}

//ajax url
function ajax_url(url='')
{
  var base_url=location.origin;

  return base_url+'/ajax/'+url;
}  