(function($){
      
  "use strict";

  //active
  $('#dashboard').addClass('active');

  //datatable
  $('.datatable').DataTable();

  //change status
  $(document).on('click','label',function(){
    var id=$(this).prev('input').attr('visit-id');
    $.ajax({
        type:'post',
        url:ajax_url("change_visit_status/"+id),
        success:function(message)
        {
            toastr.success(message);
        }
    })
  });

  //get online users
  get_online_users();

  setInterval(function(){ 
    get_online_users();
  }, 10000);

})(jQuery);


//get online users
function get_online_users()
{
  $.ajax({
    url:ajax_url('online'),
    success:function(users)
    {
      $('.change_visit_status').html(users.length);

      if(users.length==0)
      {
        $('.online_list').html(`
        <li class="item text-center">
          <p class="text-danger">`+trans("No users online")+`</p>
        </li>
        `);
      }
      else{
        var html='';
        users.forEach(user => {
          html+=`<li class="item">
                    <i class="fas fa-check-circle text-success"></i> <p class="d-inline">`+user.name+`</p>
                  </li>`;
        });
        $('.online_list').html(html);
      }

      $('.online_count').text(users.length);
      
    }
  });
}
