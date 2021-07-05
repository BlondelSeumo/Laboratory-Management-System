(function($){
    //active
    $('#translations').addClass('active');

    //change status
    $(document).on('click','.netliva-switch label',function(){
        var id=$(this).prev('input').attr('lang-id');
        console.log(id);
        $.ajax({
            type:'post',
            url:ajax_url("change_lang_status/"+id),
            success:function(message)
            {
                toastr.success(message);
            }
        });
     });

})(jQuery);
