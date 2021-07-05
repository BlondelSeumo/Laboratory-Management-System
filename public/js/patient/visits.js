(function($){

    "use strict";
    
    //active
    $('#visits').addClass('active');

    //change patient type
    $('input[type=radio]').on('change',function(){
        var type=$(this).val();
        if(type==1)
        {
           $('.select_patient').addClass('d-none');
           $("#name").val('');
           $('#name').prop('disabled',false);
           $("#phone").val('');
           $('#phone').prop('disabled',false);
           $("#email").val('');
           $('#email').prop('disabled',false);
           $("#gender").val('');
           $('#gender').prop('disabled',false);
           $("#dob").val('');
           $('#dob').prop('disabled',false);
           $("#address").val('');
           $('#address').prop('disabled',false);
           $('#patient_id').val('').trigger('change');
        }
        else{
           $('.select_patient').removeClass('d-none');
           //get patient
           $.ajax({
                beforeSend:function()
                {
                    $('.preloader').show();
                    $('.loader').show();
                },
                url:ajax_url('get_current_patient'),
                success:function(patient){
                   $('#name').val(patient.name);
                   $('#name').prop('disabled',true);
                   $('#phone').val(patient.phone);
                   $('#phone').prop('disabled',true);
                   $('#address').val(patient.address);
                   $('#address').prop('disabled',true);
                   $('#email').val(patient.email);
                   $('#email').prop('disabled',true);
                   $('#dob').val(patient.dob);
                   $('#dob').prop('disabled',true);
                   $('#gender').val(patient.gender);
                   $('#gender').prop('disabled',true);
                },
                complete:function()
                {
                    $('.preloader').hide();
                    $('.loader').hide();
                }
           });
            
        }
    });

   


    
})(jQuery);
   



//location on map
let marker;
let map;
let visit_lat=parseFloat($('#visit_lat').val());
let visit_lng=parseFloat($('#visit_lng').val());
let zoom_level=parseInt($('#zoom_level').val());

if(isNaN(visit_lat)||isNaN(visit_lng)||isNaN(zoom_level))
{
    visit_lat=26.8206;
    visit_lng=30.8025;
    zoom_level=4;
}

function initMap() {

    const myLatlng = { lat: visit_lat, lng: visit_lng};

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
    $('#visit_lat').val(latLng.lat());
    $('#visit_lng').val(latLng.lng());
    $('#zoom_level').val(map.getZoom());

}