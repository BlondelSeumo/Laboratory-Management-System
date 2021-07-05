(function($){


    "use strict";

    $.widget.bridge('uibutton', $.ui.button);
    
    //datepicker
    var date=new Date();
    var current_year=date.getFullYear();
    $('.datepicker').datepicker({
      dateFormat:"dd-mm-yy",
      changeYear: true,
      changeMonth: true,
      yearRange:"1900:"+current_year

    });

    //Date range picker
    var ranges={};
    ranges[trans('Today')]=[moment(), moment()];
    ranges[trans('Yesterday')]=[moment().subtract('days', 1), moment().subtract('days', 1)];
    ranges[trans('Last 7 Days')]=[moment().subtract('days', 6), moment()];
    ranges[trans('Last 30 Days')]=[moment().subtract('days', 29), moment()];
    ranges[trans('This Month')]=[moment().startOf('month'), moment().endOf('month')];
    ranges[trans('Last Month')]=[moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')];
    ranges[trans('This Year')]=[moment().startOf('year'), moment().endOf('year')];
    ranges[trans('Last Year')]=[moment().subtract(1,'year').startOf('year'), moment().subtract(1,'year').endOf('year')];

    $('.datepickerrange').daterangepicker({
      locale:{
        "applyLabel": trans("Save"),
        "cancelLabel": trans("Cancel"),
      },
      ranges,
      startDate: moment().subtract('days', 29),
      endDate: moment()
    },
    function(start, end) {
        $('#dateRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    $('.datepickerrange').on( 'cancel.daterangepicker', function(){
      $(this).val('');
    });

    //validation
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

    
    //inialize datatable
    $("#example1").DataTable({
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
      "serverSide": false,
      "bSort" : false,
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

    $('.datatable').DataTable({
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
        "serverSide": false,
        "bSort" : false,
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

    //initialize select2
    $('.select2').select2({
      width:"100%"
    });

    //intialize toastr
    toastr.options = {
      "debug": false,
      "positionClass": "toast-top-center",
      "onclick": null,
      "fadeIn": 300,
      "fadeOut": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000
    }
    

    //initialize lightbox images
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
    
    //get unread messages
    get_unread_messages();

    //get new visits
    get_new_visits();
   
    setInterval(function(){
      get_new_visits();
      get_unread_messages();
    },60000);


    $(window).on('load',function() {
      $('.preloader').hide();
      $('.loader').hide();
    });
})(jQuery);

//toastr success message
function toastr_success(message)
{
    toastr.success(message,trans('Success'));
}

//toastr error message
function toastr_error(message)
{
    toastr.error(message,trans('Failed'));
}


//sumbmit delete form
function delete_submit(el)
{
   $(el).parent().submit();
}

//get unread messages
function get_unread_messages()
{
  $.ajax({
    url:ajax_url('get_unread_messages'),
    success:function(messages)
    {
       
      var html=``;
      
      if(messages.length>0)
      {
        messages.forEach(function(message){
          
          html+=`<a href="`+url('admin/chat')+`" class="dropdown-item">
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          `+message.from_user.name+`
                        </h3>
                        <p class="text-sm">`+message.message.substr(0,20)+`...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>`+message.since+`</p>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>`;
    
        });

        $('.unread_messages_count').text(messages.length);
        
      }
      else{
        html+=`<p class="text-center">`+trans("No new messages")+`</p>`;

        $('.unread_messages_count').text('');
      }
      
      $('.list_unread_messages').html(html);
  
    }
  });
}

//get new messages
function get_new_visits()
{
  $.ajax({
    url:ajax_url("get_new_visits"),
    success:function(visits)
    {
      var html=``;

      if(visits.length>0)
      {
        visits.forEach(function(visit){
          html+=`<a href="`+url('admin/visits/'+visit.id)+`" class="dropdown-item">
                  <i class="fas fa-home mr-2"></i>`+visit.patient.name+`
                  <span class="float-right text-muted text-sm">`+visit.since+`</span>
                </a>`;
        });
     
        $('.visits_count').text(visits.length);

        $('.list_visits').html(html);

      }
      else{
        $('.visits_count').text('');

        $('.list_visits').html(`<p class="text-center">`+trans("No new visits")+`</p>`);
      }
    
    }
  });
}

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







