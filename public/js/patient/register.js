(function($){

    "use strict";

    //datepicker
    var date=new Date();
    var current_year=date.getFullYear();
    $('.datepicker').datepicker({
        dateFormat:"dd-mm-yy",
        changeYear: true,
        changeMonth: true,
        yearRange:"1980:"+current_year
    });

})(jQuery);
