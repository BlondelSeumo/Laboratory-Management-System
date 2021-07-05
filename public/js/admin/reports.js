    var count=0;
    var antibiotic_count=$('#antibiotic_count').val();

    (function($){
        
        "use strict";

        //active
        $('#reports').addClass('active');

        //reports datatables
        var table=$('#reports_table').DataTable( {
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
                url: url("admin/get_reports"),
                data:function(data)
                {
                    data.filter_status=$('#filter_status').val();
                    data.filter_barcode=$('#filter_barcode').val();
                    data.filter_date=$('#filter_date').val();
                }
            },
            // orderCellsTop: true,
            fixedHeader: true,
            "columns": [
                {data:"id"},
                {data:"barcode"},
                {data:"patient.code"},
                {data:"patient.name"},
                {data:"patient.gender"},
                {data:"patient.age",searchable:false,orderable:false,sortable:false},
                {data:"patient.phone"},
                {data:"tests",searchable:false,orderable:false,sortable:false},
                {data:"created_at",searchable:false,orderable:false,sortable:false},
                {data:"done",searchable:false,sortable:false,orderable:false},
                {data:"signed",searchable:false,sortable:false,orderable:false},
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

        $('#filter_status').on('change',function(){
            table.draw();
        });

        $('#filter_barcode').on('input',function(){
            table.draw();
        });

        // filter date
        $('#filter_date').on( 'cancel.daterangepicker', function(){
            $(this).val('');
            table.draw();
        });

        $('#filter_date').on('apply.daterangepicker',function(){
            table.draw();
        });

        $('.datepickerrange').val('');

        var patient_code=$('#patient_code').val();

        //QRCode
        $(".patient_qrcode").ClassyQR({
            create: true,
            size: '180',
            type: 'url',
            url:url('login/'+patient_code)
        });  

      
        //intialize antibiotics select2
        $('.antibiotic').select2({
            placeholder:trans('Select antibiotic'),
            width:'100%'
        });

       $('.sensitivity').select2({
            placeholder:trans('Select sensitivity'),
            width:'100%'
        });

        $('.select_result').select2({
            width:"100%",
            tags: true
        });
  
      //delete row
      $(document).on('click','.delete_row',function(){
  
        var conf=window.confirm(trans('Are you sure to delete antibiotic ?'));
  
        if(conf)
        {
            $(this).closest('tr').remove();
        }
  
      });
      
      //validate printing
      $('#print_form').on('submit',function(){
        var count_tests=$('input[type=checkbox]:checked').length;
        if(count_tests==0)
        {
        toastr.error(trans('Please select at least one test'),trans('Failed'));

        return false;
        }
      });

      //validate culture result
      $('.culture_form').on('submit',function(){
       var count_antibiotics=$(this).find('.antibiotics tr').length;
      
       if(count_antibiotics==0)
       {
           toastr.error(trans('Please select at least one antibiotic'),trans('Failed'));

           return false;
       }

      });

      //select all
      $('.select_all').on('click',function(){
        $('input[type=checkbox]').prop('checked',true);
      });

      $('.deselect_all').on('click',function(){
        $('input[type=checkbox]').prop('checked',false);
      });

    //print barcode
    $(document).on('click','.print_barcode',function(){
        var group_id=$(this).attr('group_id');
        $('#print_barcode_form').attr('action',url('admin/groups/print_barcode/'+group_id));
    });

    $(document).on('submit','#print_barcode_form',function(){
        $('#print_barcode_modal').modal('toggle');
    });

    //active tabs
    $('.nav-tabs').each(function(){
        $(this).find('.nav-link').first().addClass('active');
    });

    $('.tab-content').each(function(){
        $(this).find('.tab-pane').first().addClass('active');
    });
})(jQuery);


     //analyses functions
     function check_analyses_all(el)
     {
         var checked=$(el).prop('checked');

         if(checked)
         {
             $('.analyses_select').each(function(){
               $(this).prop('checked',true);
             });
         }
         else{
           $('.analyses_select').each(function(){
               $(this).prop('checked',false);
             });
         }

     }
     
     //print all analyses
     function print_analyses_all()
     {
       $('.analyses_select').prop('checked',true);

       $('#check_analyses_all').prop('checked',true);

       var html='';

       $('.analyses_select:checked').parent().parent().find('.card-body').each(function(){
          
          html+=$(this).html();
          
      });

       print_analyses(html);
     }

     //print selected analyses
     function print_analyses_selected()
     {
       var html='';

       $('.analyses_select:checked').parent().parent().find('.card-body').each(function(){
          
          html+=$(this).html();
       });

       print_analyses(html);

     }
     
     //print analyses that have result
     function print_analyses_has_result()
     {
       var html='';

       $('.analyses_select[value="has_entered"]').parent().parent().find('.card-body').each(function(){
           html+=$(this).html();
       });

       print_analyses(html);
     }
     

     //print analyses
     function print_analyses(html)
     {
       $('.printable .content').html('');


       $('.printable .content').append(html);


       $('.printable').show();


       $(".printable").print({
           //Use Global styles
           globalStyles : true,
           //Add link with attrbute media=print
           mediaPrint : false,
           //Custom stylesheet
           stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
           //Print in a hidden iframe
           iframe : false,
           //Don't print this
           noPrintSelector : ".avoid-this",
           //Log to console when printing is done via a deffered callback
           deferred: $.Deferred().done(function() { $('.printable').hide() })
       });

     }


    //make all cultures selected
    function check_cultures_all(el)
    {
        var checked=$(el).prop('checked');

        if(checked)
        {
            $('.cultures_select').each(function(){
                $(this).prop('checked',true);
            });
        }
        else{
            $('.cultures_select').each(function(){
                $(this).prop('checked',false);
            });
        }
    }

    //print all cultures
    function print_cultures_all()
    {
        var print_header=`<table class="printable_content" width="100%;">`+$('.page-header').html()+`<tbody><tr><td width="3%"></td><td><div class="content">`;
        var print_footer=`</div></td><td width="3%"></td></tr></tbody>`+$('.page-footer').html()+'</table>';  
        
        $('.cultures_select').prop('checked',true);

        $('#check_cultures_all').prop('checked',true);

        var html='';

        $('.cultures_select:checked').parent().parent().find('.card-body').each(function(){

            html+=print_header;
            
            html+=$(this).html();

            html+=print_footer;
            
        });

        print_cultures(html);
    }
    
    //print selected cultures
    function print_cultures_selected()
    {
        var print_header=`<table class="printable_content" width="100%;">`+$('.page-header').html()+`<tbody><tr><td width="3%"></td><td><div class="content">`;
        var print_footer=`</div></td><td width="3%"></td></tr></tbody>`+$('.page-footer').html()+'</table>';  
        
        var html='';

        $('.cultures_select:checked').parent().parent().find('.card-body').each(function(){
            html+=print_header;
            
            html+=$(this).html();

            html+=print_footer;

        });

        print_cultures(html);

    }


    //print cultures that have result
    function print_cultures_has_result()
    {
        var print_header=`<table class="printable_content" width="100%;">`+$('.page-header').html()+`<tbody><tr><td width="3%"></td><td><div class="content">`;
        var print_footer=`</div></td><td width="3%"></td></tr></tbody>`+$('.page-footer').html()+'</table>';  
        
        var html='';

        $('.cultures_select[value="has_entered"]').parent().parent().find('.card-body').each(function(){
            html+=print_header;

            html+=$(this).html();

            html+=print_footer;

        });

        print_cultures(html);
    }

    //print cultures
    function print_cultures(html)
    {
        $('.printable_cultures').html('');


        $('.printable_cultures').append(html);


        $('.printable_cultures').show();

        $(".printable_cultures").print({
            //Use Global styles
            globalStyles : true,
            //Add link with attrbute media=print
            mediaPrint : false,
            //Custom stylesheet
            stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
            //Print in a hidden iframe
            iframe : false,
            //Don't print this
            noPrintSelector : ".avoid-this",
            //Log to console when printing is done via a deffered callback
            deferred: $.Deferred().done(function() { $('.printable_cultures').hide() })
        });

    

    }

    //add antibiotic
    function add_antibiotic(antibiotics,el)
    {
        var antibiotics=JSON.parse(antibiotics);

        var antibiotics_options=`
            <option value="" disabled selected>`+trans("Select Antibiotic")+`</option>
        `;

        antibiotics.forEach(function(antibiotic){
            antibiotics_options+=`
                <option value="`+antibiotic.id+`">`+antibiotic.name+`</option>
            `;
        });

        antibiotic_count++;

        $(el).closest('table').find('tbody').append(`
            <tr>
                <td>
                   <div class="form-group">
                    <select class="form-control antibiotic" name="antibiotic[`+antibiotic_count+`][antibiotic]" required>
                    `+antibiotics_options+`
                    </select>
                   </div>
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control sensitivity" name="antibiotic[`+antibiotic_count+`][sensitivity]" required>
                            <option value="" disabled selected>`+trans("Select Sensitivity")+`</option>
                            <option value="High">`+trans("High")+`</option>
                            <option value="Moderate">`+trans("Moderate")+`</option>
                            <option value="Resident">`+trans("Resident")+`</option>
                        </select>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm delete_row">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `);
  
        //setup select2
        $('.antibiotic').select2({
            placeholder:trans('Select antibiotic'),
            width:'100%'
        });

        $('.sensitivity').select2({
            placeholder:trans('Select sensitivity'),
            width:'100%'
        });

    }

   