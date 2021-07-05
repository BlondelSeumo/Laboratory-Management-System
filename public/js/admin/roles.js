
(function($){

    "use strict";

    //active
    $('#roles').addClass('active');
    $('#users_roles_link').addClass('active');
    $('#users_roles').addClass('menu-open');

    //intialize select2 for permissions
    $('.select2').select2();

    //roles datatable
    var table=$('#roles_table').DataTable( {
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-4'i><'col-sm-8'p>>",
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i> '+trans("Copy"),
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> '+trans("Excel"),
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> '+trans("CVS"),
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> '+trans("PDF"),
                titleAttr: 'PDF'
            },
            {
              extend:    'colvis',
              text:      '<i class="fas fa-eye"></i>',
              titleAttr: 'PDF'
            }
            
        ],
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: url("admin/get_roles")
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:'id'},
            {data:'name'},
            {data:"action",searchable:false,sortable:false,orderable:false},
        ],
        "language": {
            "sEmptyTable":     trans("No data available in table"),
            "sInfo":           trans("Showing")+" _START_ "+trans("to")+" _END_ "+trans("of")+" _TOTAL_ "+trans("records"),
            "sInfoEmpty":      trans("Showing")+" 0 "+trans("to")+" 0 "+trans("of")+" 0 "+trans("records"),
            "sInfoFiltered":   "("+trans("filtered")+" "+trans("from")+" _MAX_ "+trans("total")+" "+trans("records")+")",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     trans("Show")+" _MENU_ "+trans("records"),
            "sLoadingRecords": trans("Loading..."),
            "sProcessing":     trans("Processing..."),
            "sSearch":         trans("Search")+":",
            "sZeroRecords":    trans("No matching records found"),
            "oPaginate": {
                "sFirst":    trans("First"),
                "sLast":     trans("Last"),
                "sNext":     trans("Next"),
                "sPrevious": trans("Previous")
            },
        }
    });



    //delete role
    $(document).on('click','.delete_role',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: trans("Are you sure to delete role ?"),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: trans("btn-danger"),
            confirmButtonText: trans("Delete"),
            cancelButtonText: trans("Cancel"),
            closeOnConfirm: false
        },
        function(){
            $(el).parent().submit();
        });
    });

    $('.select_all_modules').on('click',function(){
        $('input[type=checkbox]').prop('checked',true);
    });

    $('.deselect_all_modules').on('click',function(){
        $('input[type=checkbox]').prop('checked',false);
    });

    $('.select_module').on('click',function(){
        $(this).parent().next('.card-body').find('input[type=checkbox]').prop('checked',true);
    });

    $('.deselect_module').on('click',function(){
        $(this).parent().next('.card-body').find('input[type=checkbox]').prop('checked',false);
    });

})(jQuery);

          
