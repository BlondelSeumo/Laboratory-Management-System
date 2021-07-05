(function($){

    "use strict";

    //active
    $('#branches').addClass('active');

    //branches datatable
    var table=$('#branches_table').DataTable( {
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
        url: url("admin/get_branches")
      },
      // orderCellsTop: true,
      fixedHeader: true,
      "columns": [
         {data:"id"},
         {data:"name"},
         {data:"phone"},
         {data:"address"},
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

    //submit map form
    $('#branch_form').on('submit',function(){
       let lat=$('#branch_lat').val();
       let lng=$('#branch_lng').val();

       if(lat==''||lng=='')
       {
           toastr.error('Please choose location on map','Failed');

           return false;
       }
    });

    //delete branch
    $(document).on('click','.delete_branch',function(e){
      e.preventDefault();
      var el=$(this);
      swal({
        title: trans("Are you sure to delete branch ?"),
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

let marker;
let map;
let branch_lat=parseFloat($('#branch_lat').val());
let branch_lng=parseFloat($('#branch_lng').val());
let zoom_level=parseInt($('#zoom_level').val());

if(isNaN(branch_lat)||isNaN(branch_lng)||isNaN(zoom_level))
{
    branch_lat=26.8206;
    branch_lng=30.8025;
    zoom_level=4;
}

function initMap() {

    const myLatlng = { lat: branch_lat, lng: branch_lng};

    map = new google.maps.Map(document.getElementById("map"), {
      zoom: zoom_level,
      center: myLatlng
    });

    marker = new google.maps.Marker({
      position: myLatlng,
      map,
      title: "Click to zoom"
    });
    
    map.addListener('click', function(e) {
        placeMarkerAndPanTo(e.latLng, map);
    });
  }

  function placeMarkerAndPanTo(latLng, map) {
      marker.setMap(null);
      marker = new google.maps.Marker({
        position: latLng,
        map: map
      });
      //set branch lat and lng
      $('#branch_lat').val(latLng.lat());
      $('#branch_lng').val(latLng.lng());
      $('#zoom_level').val(map.getZoom());

  }



 