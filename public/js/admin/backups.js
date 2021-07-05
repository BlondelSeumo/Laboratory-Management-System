(function($){

    "use strict";

    //active
    $('#backups').addClass('active');

    //delete backup
    $(document).on('click','.delete_backup',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: trans("Are you sure to delete backup ?"),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: trans("Delete"),
            cancelButtonText: trans("Cancel"),
            closeOnConfirm: false
        },
        function(){
            $(el).parent().submit();
        });
    });
    
})(jQuery);
