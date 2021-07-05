//currency
var currency=$('#system_currency').val();
var patient_code=$('#patient_code').val();
var contract_id=$('#contract_id').val();

//branch
var branch_id=$('#branch_id').val();

//patient_id
var visit_patient_id=$('#visit_patient_id').val();

(function($){

   "use strict";
    
   //active
   $('#groups').addClass('active');

   //admin groups datatable
   var table=$('#groups_table').DataTable( {
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
        url: url("admin/get_groups"),
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
         {data:"subtotal"},
         {data:"discount"},
         {data:"total"},
         {data:"paid"},
         {data:"due"},
         {data:"created_at"},
         {data:"done",searchable:false,orderable:false,sortable:false},//done
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


   //contract select2
   $('#contract_discount').select2({
      placeholder:trans("Select contract"),
      width:'100%'
   });


   if(contract_id!='')
   {
      $('#contract_discount').val(contract_id).trigger('change');
   }

   //contract change
   $('#contract_discount').on('change',function(){
      calculate_total();
   });

   //cancel contract
   $('#cancel_contract').on('click',function(){
      $('#contract_discount').val(null).trigger('change');
   });

   if(branch_id!=null)
   {
      $('#branch').val(branch_id);
   }
   
   if(!isNaN(patient_code))
   {
      //QRCode
      $(".patient_qrcode").ClassyQR({
         create: true,
         size: '180',
         type: 'url',
         url:url('patient/login/'+patient_code)
      });
   }
   
   $('footer').addClass('no-print');


   //get doctor select2 intialize
   $('#doctor').select2({
      width:"100%",
      placeholder:trans("Doctor"),
      ajax: {
         beforeSend:function()
         {
            $('.preloader').show();
            $('.loader').show();
         },
         url: ajax_url('get_doctors'),
         processResults: function (data) {
               return {
                     results: $.map(data, function (item) {
                        return {
                           text: item.name,
                           id: item.id
                        }
                     })
               };
            },
            complete:function()
            {
               $('.preloader').hide();
               $('.loader').hide();
            }
         }
    });

   //get patient by code
   $('#code').select2({
      width:"100%",
      placeholder:trans("Patient Code"),
      ajax: {
         beforeSend:function()
         {
            $('.preloader').show();
            $('.loader').show();
         },
         url: ajax_url('get_patient_by_code'),
         processResults: function (data) {
               return {
                     results: $.map(data, function (item) {
                        return {
                           text: item.code,
                           id: item.id
                        }
                     })
               };
            },
            complete:function()
            {
               $('.preloader').hide();
               $('.loader').hide();
            }
         }
   });

   //selected code
   $(document).on('select2:select','#code', function (e) {
      var el=$(e.target);
      var data = e.params.data;
      $.ajax({
          url:ajax_url('get_patient'+'?id='+data.id),
          beforeSend:function(){
            $('.preloader').show();
            $('.loader').show();
          },
          success:function(patient)
          {
            $("#name").append('<option value="'+patient.id+'">'+patient.name+'</option>');
            $("#name").val(patient.id).trigger('change');
            $("#phone").val(patient.phone);
            $("#email").val(patient.email);
            $("#gender").val(patient.gender);
            $("#dob").val(patient.dob);
            $("#address").val(patient.address);
          },
          complete:function()
          {
            $('.preloader').hide();
            $('.loader').hide();
          }
      });
   });

   //get patient by name select2
   $('#name').select2({
      width:"100%",
      placeholder:trans("Patient Name"),
      ajax: {
         beforeSend:function()
         {
            $('.preloader').show();
            $('.loader').show();
         },
         url: ajax_url('get_patient_by_name'),
         processResults: function (data) {
               return {
                     results: $.map(data, function (item) {
                        return {
                           text: item.name,
                           id: item.id
                        }
                     })
               };
            },
         complete:function()
         {
            $('.preloader').hide();
            $('.loader').hide();
         }
      }
   });
  
   //selected name
   $(document).on('select2:select','#name', function (e) {
      var el=$(e.target);
      var data = e.params.data;
      $.ajax({
          url:ajax_url('get_patient'+'?id='+data.id),
          beforeSend:function(){
               $('.preloader').show();
               $('.loader').show();
          },
          success:function(patient)
          {
            $("#code").append('<option value="'+patient.id+'">'+patient.code+'</option>');
            $("#code").val(patient.id).trigger('change');
            $("#phone").val(patient.phone);
            $("#email").val(patient.email);
            $("#gender").val(patient.gender);
            $("#dob").val(patient.dob);
            $("#address").val(patient.address);
          },
         complete:function()
         {
            $('.preloader').hide();
            $('.loader').hide();
         }
      });
   });

   //create patient
   $('#create_patient').on('submit',function(e){
      e.preventDefault();
      
      var data=$('#create_patient').serialize();

      var valid=$(this).valid();

      if(valid)
      {
         $.ajax({
           url:ajax_url("create_patient"),
           type:"post",
           data:data,
           beforeSend:function(){
               $('.preloader').show();
               $('.loader').show();
            },
           success:function(data){
                $('#name').append(`<option value="`+data.id+`">`+data.name+`</option>`);
                $('#name').val(data.id);
                $('#name').trigger({
                    type: 'select2:select',
                    params: {
                        data:{
                            id:data.id,
                            text:data.name
                        }
                    }
                });
                $('#patient_modal').modal('hide');
                $('#patient_modal_error').html(``);
                $('#create_patient_inputs input').val(``);
                toastr.success(trans('Patient saved successfully'),trans('Success'));
           },
           error:function(xhr, status, error){
               toastr.error(trans('Something went wrong'),trans('Failed'));
               var errors=xhr.responseJSON.errors;
               var error_html=`<div class="callout callout-danger">
                                 <h5 class="text-danger">
                                    <i class="fa fa-times"></i> `+trans('Failed')+`
                                 </h5>
                                 <ul>`;
               for (var key in errors){
                  error_html+=`<li>`+errors[key]+`</li>`;
               }
               error_html+=`</ul></div>`;
               $('#patient_modal_error').html(error_html);
           },
           complete:function()
           {
              $('.preloader').hide();
              $('.loader').hide();
           }
       });

      }
      else{
         return false;
      }

      
   });

   //create doctor
   $('#create_doctor').on('submit',function(e){
      e.preventDefault();
      
      var data=$('#create_doctor').serialize();
       
      var valid=$(this).valid();

      if(valid)
      {
         $.ajax({
            url:ajax_url("create_doctor"),
            type:"post",
            data:data,
            beforeSend:function(){
               $('.preloader').show();
               $('.loader').show();
            },
            success:function(data){
               $('#doctor').append(`<option value="`+data.id+`">`+data.name+`</option>`);
               $('#doctor').val(data.id).trigger('select2:select');
               $('#doctor_modal').modal('hide');
               toastr.success(trans('Patient saved successfully'),trans('Success'));
               $('#doctor_modal_error').html(``);
               $('#create_doctor_inputs input').val(``);
            },
            error:function(xhr, status, error){
                  toastr.error(trans('Something went wrong'),trans('Failed'));
                  var errors=xhr.responseJSON.errors;
                  var error_html=`<div class="callout callout-danger">
                                    <h5 class="text-danger">
                                       <i class="fa fa-times"></i> `+trans("Failed")+`
                                    </h5>
                                    <ul>`;
                  for (var key in errors){
                     error_html+=`<li>`+errors[key]+`</li>`;
                  }
                  error_html+=`</ul></div>`;
                  $('#doctor_modal_error').html(error_html);
            },
            complete:function()
            {
               $('.preloader').hide();
               $('.loader').hide();
            }
         });
      }
   });
   
   //calculations
   $('#discount').on('change',function(){
      var discount=$(this).val();
      if(isNaN(discount)||discount<=0)
      {
        $('#discount').val(0);
      }
      calculate_total();
   });

   //paid
   $('#paid').on('change',function(){
      var paid=$(this).val();
      if(isNaN(paid)||paid<=0)
      {
        $('#paid').val(0);
      }
      calculate_total();
   });

   //end calculations

   //delete group
   $(document).on('click','.delete_group',function(e){
      e.preventDefault();
      var el=$(this);
      swal({
        title: trans("Are you sure to delete group ?"),
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

   //selected tests
   if(typeof test_arr !== 'undefined'&&test_arr.length>0)
   {
      test_arr.forEach(function(test_id){
         var test=$('#test_'+test_id);
         var price=$(test).attr('price');
         $('#test_'+test_id).prop('checked',true);
         $('.tests').append(`
         <div class="selected_tests" id="selected_test_`+test_id+`">
            <input type="hidden"  name="tests[]" value="`+test_id+`">
            <input type="hidden"  class="price" value="`+price+`">
         </div>`);
      });
   }

   //selected tests
   if(typeof culture_arr !== 'undefined'&&culture_arr.length>0)
   {
      culture_arr.forEach(function(culture_id){
         var culture=$('#culture_'+culture_id);
         var price=$(culture).attr('price');
         $('#culture_'+culture_id).prop('checked',true);
         $('.cultures').append(`
         <div class="selected_tests" id="selected_culture_`+culture_id+`">
            <input type="hidden"  name="cultures[]" value="`+culture_id+`">
            <input type="hidden"  class="price" value="`+price+`">
         </div>`);
      });
   }

   //test selected
   $(document).on('change','.test',function(){
      var checked=$(this).prop('checked');
      var test_id=$(this).val();
      var price=$(this).attr('price');
      if(checked)
      {
         $('.tests').append(`
         <div class="selected_tests" id="selected_test_`+test_id+`">
            <input type="hidden"  name="tests[]" value="`+test_id+`">
            <input type="hidden"  class="price" value="`+price+`">
         </div>`);
      }
      else{
         $('#selected_test_'+test_id).remove();
      }
      calculate_total();
   });


   //datatables
   $('.datatables').dataTable();

   //culture selected
   $(document).on('change','.culture',function(){
      var checked=$(this).prop('checked');
      var culture_id=$(this).val();
      var price=$(this).attr('price');
      if(checked)
      {
         $('.cultures').append(`
         <div class="selected_tests" id="selected_culture_`+culture_id+`">
            <input type="hidden"  name="cultures[]" value="`+culture_id+`">
            <input type="hidden"  class="price" value="`+price+`">
         </div>`);
      }
      else{
         $('#selected_culture_'+culture_id).remove();
      }
      calculate_total();
   });

   //submit form
   $('#group_form').on('submit',function(){
      var count_tests=$('.selected_tests').length;
      if(!count_tests)
      {
         toastr.error(trans('Please select at least one test'),trans('Failed'));
         return false;
      }
   });

   //home visit patient
   if(visit_patient_id!=null)
   {
      var visit_patient_name=$('#visit_patient_id').attr('patient_name');
      var data = {
         id: visit_patient_id,
         text: visit_patient_name
      };
      var newOption = new Option(data.text, data.id, false, false);
      $('#name').append(newOption).trigger('change');
      $.ajax({
            url:ajax_url('get_patient'+'?id='+visit_patient_id),
            beforeSend:function(){
               $('.preloader').show();
               $('.loader').show();
            },
            success:function(patient)
            {
               $("#code").append('<option value="'+patient.id+'">'+patient.code+'</option>');
               $("#code").val(patient.id).trigger('change');
               $("#phone").val(patient.phone);
               $("#email").val(patient.email);
               $("#gender").val(patient.gender);
               $("#dob").val(patient.dob);
               $("#address").val(patient.address);
            },
            complete:function()
            {
               $('.preloader').hide();
               $('.loader').hide();
            }
      });
   }

   //print barcode
   $(document).on('click','.print_barcode',function(){
      var group_id=$(this).attr('group_id');
      $('#print_barcode_form').attr('action',url('admin/groups/print_barcode/'+group_id));
   });

   $(document).on('submit','#print_barcode_form',function(){
      $('#print_barcode_modal').modal('toggle');
   });
   
})(jQuery);


//calculations
function calculate_total()
{
   //calculate subtotal
   var subtotal=0;

   $('.price').each(function(){
      var price=parseFloat($(this).val());
      subtotal+=parseFloat(price);
   });

  $('#subtotal').val(subtotal);

  //calculate discount
  var discount=0;

  var discount_percentage=$("#contract_discount option:selected").attr('discount');

  if(discount_percentage)
  {
      discount_percentage=parseFloat($("#contract_discount option:selected").attr('discount'));

      discount=(subtotal*discount_percentage)/100;

      $('#discount').val(discount); 
  }
  else{
      $('#discount').val(0); 
  }

  //calculate total
  var total=subtotal-discount;

  $('#total').val(total);

  //calculate due
  var paid=$('#paid').val();

  var due=total-paid;

  $('#due').val(due);
}


//delete group test
function delete_row()
{
   var confirm=window.confirm(trans('Are you sure to delete group test ?'));
   return confirm;
}


 //print receipt
 function print(patient_code)
 {
   $("#invoice").print({
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
       deferred: $.Deferred().done(function() { })
   });

 }

