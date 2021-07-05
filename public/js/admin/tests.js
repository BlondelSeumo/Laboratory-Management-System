var system_currency=$('#system_currency').val();
var count=$('#count').val();
var option_count=$('#option_count').val();

(function($){

    "use strict";

    //active
    $('#tests').addClass('active');

    //tests datatable
    var table=$('#tests_table').DataTable( {
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
          titleAttr: 'colvis'
        }
        
      ],
      "processing": true,
      "serverSide": true,
      "bSort" : false,
        "ajax": {
          url: url("admin/get_tests")
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
           {data:"id"},
           {data:"name"},
           {data:"shortcut"},
           {data:"sample_type"},
           {data:"price"},
           {data:"action",searchable:false,orderable:false,sortable:false}//action
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
    
    // text editor
    $('.components').find('textarea').summernote({
      toolbar: []
    });

    //components

    $('.add_component').on('click',function(){
            count++;
            $('.components .items').append(`
            <tr id="component_`+count+`" num="`+count+`">
               <td>
                    <div class="form-group">
                        <input type="text" class="form-control" name="component[`+count+`][name]" placeholder="`+trans('Component')+`" required>
                    </div>
               </td>
               <td>
                    <div class="form-group">
                        <input type="text" class="form-control" name="component[`+count+`][unit]" placeholder="`+trans('Unit')+`" required>
                    </div>
               </td>
               <td>
                    <ul class="p-0 list-style-none">
                        <li>
                            <input class="select_type" value="text" type="radio" name="component[`+count+`][type]" id="text_`+count+`"  required> <label for="text_`+count+`">`+trans('Text')+`</label>
                        </li>
                        <li>
                            <input class="select_type" value="select" type="radio" name="component[`+count+`][type]" id="select_`+count+`"  required> <label for="select_`+count+`">`+trans('Select')+`</label>
                        </li>
                    </ul>
                    <div class="options">
                    </div>
               </td>
               <td>
                    <div class="form-group">
                        <textarea class="form-control" name="component[`+count+`][reference_range]" placeholder="`+trans('Reference Range')+`"></textarea>
                    </div>
               </td>
               <td class="text-center">
                    <input class="check_separated" num="`+count+`" type="checkbox" name="component[`+count+`][separated]">
                    <div class="component_price">
                    </div>
               </td>
               <td class="text-center">
                    <input  type="checkbox" name="component[`+count+`][status]">
                </td>
               <td>
                    <button type="button" class="btn btn-danger delete_row">
                        <i class="fa fa-trash"></i>
                    </button>
               </td>
            </tr>
            `);
            //initialize text editor
            $('#component_'+count).find('textarea').summernote({
                toolbar: []
            });
    });

    //add title
    $('.add_title').on('click',function(){
        count++;
        $('.components .items').append(`
          <tr num="`+count+`" id="component_`+count+`">
            <td colspan="6">
               <div class="form-group">
                    <input type="hidden" name="component[`+count+`][title]" value="true">
                    <input type="text" class="form-control" name="component[`+count+`][name]" placeholder="`+trans('Title')+`" required>
               </div>
            </td>
           
            <td>
                <button type="button" class="btn btn-danger delete_row">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
          </tr>
        `);

        $('#component_'+count+' input').focus();
    });

    //delete test component
    $(document).on('click','.delete_row',function(){
        var test_id=$(this).closest('tr').attr('test_id');
        var el=$(this);

        swal({
          title: trans("Are you sure to delete component ?"),
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: trans("Delete"),
          cancelButtonText: trans("Cancel"),
          closeOnConfirm: true
        },
        function(){
          if(test_id!==undefined)
          {
            $.ajax({
              url:ajax_url('delete_test/'+test_id),
              beforeSend:function()
              {
                 $('.preloader').show();
                 $('.loader').show();
              },
              success:function()
              {
                $(el).parent().parent().remove();
              },
              complete:function(){
                $('.preloader').hide();
                $('.loader').hide();
              }
            });
          }
          else{
            $(el).parent().parent().remove();
          }
          
        });

    });

    //check if selected components
    $('#test_form').on('submit',function(){
      var count_components=$('.components tbody tr').length;

      if(count_components==0)
      {
        toastr.error(trans('Please select at least one test component'),trans('Failed'));
        return false;
      }

    });

    //delete test
    $(document).on('click','.delete_test',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
          title: trans("Are you sure to delete test ?"),
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

  //select type
  $(document).on('change','.select_type',function(){
    option_count++;
    var type=$(this).val();
    var component_num=$(this).parent().parent().parent().parent().attr('num');
    var html=`
     <table width="100%">
        <thead>
           <tr>
             <th>`+trans('Option')+`</th>
             <th width="10px">
              <button type="button" class="btn btn-primary btn-sm add_option">
                <i class="fa fa-plus"></i>
              </button>
             </th>
           </tr>
        </head>
        <tbody>
          <tr>
            <td>
              <input type="text" name="component[`+component_num+`][options][`+option_count+`]" class="form-control" required>
            </td>
            <td>
              <button type="button" class="btn btn-danger btn-sm delete_option">
                <i class="fa fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
     </table>
    `;
    if(type=='select')
    {
      $(this).parent().parent().next('.options').html(html);
    }
    else{
      $(this).parent().parent().next('.options').html('');
    }
  });
  
  //delete select option
  $(document).on("click",".delete_option",function(){
    var option_id=$(this).closest('tr').attr('option_id');
    var option=$(this);
    swal({
      title: trans("Are you sure to delete option ?"),
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: trans("Delete"),
      cancelButtonText: trans("Cancel"),
      closeOnConfirm: true
    },
    function(){
      if(option_id!==undefined)
      {
        $.ajax({
          url:ajax_url('delete_option/'+option_id),
          beforeSend:function()
          {
            $('.preloader').show();
            $('.loader').show();
          },
          success:function()
          {
            $(option).parent().parent().remove();
          },
          complete:function(){
            $('.preloader').hide();
            $('.loader').hide();
          }
        });
      }
      else{
        $(this).parent().parent().remove();
      }
    });
  });

  //add option 
  $(document).on('click','.add_option',function(){
    option_count++;
    console.log(option_count);
    var component_num=$(this).parent().parent().parent().parent().parent().parent().parent().attr('num');
    var html=`<tr>
                <td>
                  <input type="text" name="component[`+component_num+`][options][`+option_count+`]" class="form-control" required>
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm delete_option">
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>`;
    $(this).parent().parent().parent().next('tbody').append(html);
  });

  //separated component
  $(document).on('change','.check_separated',function(){
    var checked=$(this).prop('checked');
    var num=$(this).attr('num');
    if(checked)
    {
      $(this).next('.component_price').html(`
        <div class="card card-primary">
          <div class="card-header">
            <h5 class="card-title">
              `+trans('Price')+`
            </h5>
          </div>
          <div class="card-body">
            <div class="input-group form-group mb-3">
                <input type="number" class="form-control" name="component[`+num+`][price]" min="0" class="price" required>
                <div class="input-group-append">
                  <span class="input-group-text">
                      `+system_currency+`
                  </span>
                </div>
            </div>
          </div>
        </div>
      `);
    }
    else{
      $(this).next('.component_price').html(``);
    }
  });

})(jQuery);

