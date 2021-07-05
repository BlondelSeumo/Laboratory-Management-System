// const { transform } = require("lodash");

(function($){

    "use strict";
  
    var current_user=$('#current_user').val();
    
    //active
    $('#chat').addClass('active');
  
    //sync messages
    setInterval(function(){
      sync_messages();
    },5000);
  

    //get user unread count
    get_unread_messages_count();
    setInterval(function(){
        get_unread_messages_count();
    },60000);
    
    //load more messages
    $(document).on('click','.load_more',function(){
        load_more();
    });
  
  
  
    $('.video-call-screen').off('click').on('click', function(event) {
      var getCallingUserName = $(this).parents('.chat-system').find('.person.active .user-name').attr('data-name');
      var getCallingUserImg = $(this).parents('.chat-system').find('.person.active .f-head img').attr('src');
      var setCallingUserName = $(this).parents('.chat-box').find('.overlay-video-call .user-name').text(getCallingUserName);
      var setCallingUserName = $(this).parents('.chat-box').find('.overlay-video-call .calling-user-img img').attr('src', getCallingUserImg);
      var applyOverlay = $(this).parents('.chat-box').find('.overlay-video-call').addClass('video-call-show');
      setTimeout(videoCallOnConnect, 2000);
    })
    
    $('.switch-to-phone-call').off('click').on('click', function(event) {
        var getCallerId = $(this).parents('.overlay-video-call').find('.user-name').text();
        var getCallerImg = $(this).parents('.overlay-video-call').find('.calling-user-img img').attr('src');
    
        $(this).parents('.overlay-video-call').removeClass('video-call-show');
        $('.overlay-phone-call').addClass('phone-call-show');
        $('.overlay-phone-call').find('.user-name').text(getCallerId);
        $('.overlay-phone-call').find('.calling-user-img img').attr('src', getCallerImg);
    
        var removeOverlay = $(this).parents('.overlay-video-call').removeClass('video-call-show');
        var setCallStatusText =  $(this).parents('.overlay-video-call').find('.call-status').text('Calling...');
        var removeVideoConnectClass = $(this).parents('.overlay-video-call').removeClass('onConnect');
        var displayCallerImage = $(this).parents('.overlay-video-call').find('.calling-user-img').css('display', 'block');
        var hideVideoCallTimerDiv = $(this).parents('.overlay-video-call').find('.timer').removeAttr('style');
        setTimeout(callOnConnect, 2000);
    })
    
    $('.mail-write-box').on('keydown', function(event) {
        if(event.key === 'Enter') {
            var chatInput = $(this);
            var chatMessageValue = chatInput.val();
            if (chatMessageValue === '') { return; }
            //get current user chatting
            var user_id=$('.person.active').attr('user-id');
            //send message
            $.ajax({
                url:ajax_url("send_message/"+user_id),
                type:"post",
                data:{message:chatMessageValue},
                success:function(message){
                    var html=``;
                    if(message.from==current_user)
                    {
                      html+=`<div class="bubble me" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                      if(message.read)
                      {
                        html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;text-align:right"></i>`;
                      }
                      else{
                        html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;text-align:right"></i>`;
                      }
                      html+=`</div>`;
                    }   
                    else{
                     html+=`<div class="bubble you" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                     if(message.read)
                     {
                         html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;text-align:right"></i>`;
                     }
                     else{
                         html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;text-align:right"></i>`;
                     }
                     html+=`</div>`;
                    }  

                    $('.chat-system').find('.active-chat').append(html);

                    const ps = new PerfectScrollbar('.chat-conversation-box', {
                        suppressScrollX : true
                    });
            
                    const getScrollContainer = document.querySelector('.chat-conversation-box');
                    getScrollContainer.scrollTop = $('#chat_'+user_id)[0].scrollHeight;
            
                },

                
          });
         
          var clearChatInput = chatInput.val('');
          
    
        }
    })
    
    $('.hamburger, .chat-system .chat-box .chat-not-selected p').on('click', function(event) {
      $(this).parents('.chat-system').find('.user-list-box').toggleClass('user-list-box-show')
    })
  
  
    $('.phone-call-screen').off('click').on('click', function(event) {
      var getCallingUserName = $(this).parents('.chat-system').find('.person.active .user-name').attr('data-name');
      var getCallingUserImg = $(this).parents('.chat-system').find('.person.active .f-head img').attr('src');
      var setCallingUserName = $(this).parents('.chat-box').find('.overlay-phone-call .user-name').text(getCallingUserName);
      var setCallingUserName = $(this).parents('.chat-box').find('.overlay-phone-call .calling-user-img img').attr('src', getCallingUserImg);
      var applyOverlay = $(this).parents('.chat-box').find('.overlay-phone-call').addClass('phone-call-show');
      setTimeout(callOnConnect, 2000);
    })
    
    $('.switch-to-video-call').off('click').on('click', function(event) {
        var getCallerId = $(this).parents('.overlay-phone-call').find('.user-name').text();
        var getCallerImg = $(this).parents('.overlay-phone-call').find('.calling-user-img img').attr('src');
        $(this).parents('.overlay-phone-call').removeClass('phone-call-show');
        $('.overlay-video-call').addClass('video-call-show');
        $('.overlay-video-call').find('.user-name').text(getCallerId);
        $('.overlay-video-call').find('.calling-user-img img').attr('src', getCallerImg);
        var removeOverlay = $(this).parents('.overlay-phone-call').removeClass('phone-call-show');
        var getCallStatusText = $(this).parents('.overlay-phone-call').find('.call-status').text('Calling...');
        var getCallStatusTimer = $(this).parents('.overlay-phone-call').find('.timer').removeAttr('style');
        setTimeout(videoCallOnConnect, 2000);
    })
    $('.switch-to-microphone').off('click').on('click', function(event) {
      var toggleClass = $(this).toggleClass('micro-off');
    })
  
    $('.cancel-call').on('click', function(event) {
    
        if ($(this).parents('.overlay-phone-call').hasClass('phone-call-show')) {
          var removeOverlay = $(this).parents('.overlay-phone-call').removeClass('phone-call-show');
          var getCallStatusText = $(this).parents('.overlay-phone-call').find('.call-status').text('Calling...');
          var getCallStatusTimer = $(this).parents('.overlay-phone-call').find('.timer').removeAttr('style');
        } else if ($(this).parents('.overlay-video-call').hasClass('video-call-show')) {
          var removeOverlay = $(this).parents('.overlay-video-call').removeClass('video-call-show');
          var setCallStatusText =  $(this).parents('.overlay-video-call').find('.call-status').text('Calling...');
          var removeVideoConnectClass = $(this).parents('.overlay-video-call').removeClass('onConnect');
          var displayCallerImage = $(this).parents('.overlay-video-call').find('.calling-user-img').css('display', 'block');
          var hideVideoCallTimerDiv = $(this).parents('.overlay-video-call').find('.timer').removeAttr('style');
        }
    })
    $('.go-back-chat').on('click', function(event) {
    
      if ($(this).parents('.overlay-phone-call').hasClass('phone-call-show')) {
        var removeOverlay = $(this).parents('.chat-box').find('.overlay-phone-call').removeClass('phone-call-show');
      } else if ($(this).parents('.overlay-video-call').hasClass('video-call-show')) {
        var removeOverlay = $(this).parents('.chat-box').find('.overlay-video-call').removeClass('video-call-show')
      }
    
    })
  
  
    $('.search > input').on('keyup', function() {
      var rex = new RegExp($(this).val(), 'i');
        $('.people .person').hide();
        $('.people .person').filter(function() {
            return rex.test($(this).text());
        }).show();
    });
    
    $('.user-list-box .person').on('click', function(event) {
        if ($(this).hasClass('.active')) {
            return false;
        } else {
            var findChat = $(this).attr('data-chat');
            var personName = $(this).find('.user-name').text();
            var personImage = $(this).find('img').attr('src');
            var hideTheNonSelectedContent = $(this).parents('.chat-system').find('.chat-box .chat-not-selected').hide();
            var showChatInnerContent = $(this).parents('.chat-system').find('.chat-box .chat-box-inner').show();
    
            if (window.innerWidth <= 767) {
              $('.chat-box .current-chat-user-name .name').html(personName.split(' ')[0]);
            } else if (window.innerWidth > 767) {
              $('.chat-box .current-chat-user-name .name').html(personName);
            }
            $('.chat-box .current-chat-user-name img').attr('src', personImage);
            $('.chat').removeClass('active-chat');
            $('.user-list-box .person').removeClass('active');
            $('.chat-box .chat-box-inner').css('height', '100%');
            $(this).addClass('active');
            $('.chat[data-chat = '+findChat+']').addClass('active-chat');
        }
        if ($(this).parents('.user-list-box').hasClass('user-list-box-show')) {
          $(this).parents('.user-list-box').removeClass('user-list-box-show');
        }
        $('.chat-meta-user').addClass('chat-active');
        $('.chat-box').css('height', 'calc(100vh - 184px)');
        $('.chat-footer').addClass('chat-active');
      
        var user_id=$(this).attr('user-id');
    
        var current_user=$('#current_user').val();
    
        $.ajax({
          url:ajax_url("get_chat/"+user_id),
          beforeSend:function(){
             $('.preloader').show();
             $('.loader').show();
          },
          success:function(messages)
          {
             //get first message for pagination
             var messages_length=messages.length;
             var first_message=messages[messages_length-1];
             //reverse messages for asc
             messages=messages.reverse();
             if(first_message!=undefined)
             {
              var html=`
              <div class="conversation-start text-center load_more">
                  <span>
                    <i class="fas fa-redo"></i> <span style="padding-left:10px">`+trans("Load More")+`</span>
                  </span>
              </div>
             <input type="hidden" value="`+first_message.id+`" class="first_message">`;

             }
             
             messages.forEach(function(message){
               if(message.from==current_user)
               {
                 html+=`<div class="bubble me" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                 if(message.read)
                 {
                   html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;text-align:right"></i>`;
                 }
                 else{
                   html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;text-align:right"></i>`;
                 }
                 html+=`</div>`;
               }   
               else{
                html+=`<div class="bubble you" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                if(message.read)
                {
                    html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;text-align:right"></i>`;
                }
                else{
                    html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;text-align:right"></i>`;
                }
                html+=`</div>`;
               }  
            });
    
            $('#chat_'+user_id).html(html);
    
            const ps = new PerfectScrollbar('.chat-conversation-box', {
              suppressScrollX : true
            });
    
            $('.chat-conversation-box').animate({
                scrollTop: 0
            }, 1);
            $('.chat-conversation-box').animate({
              scrollTop: $('#chat_'+user_id).height()
            }, 1);
    
    
          },
          complete:function(){
             $('.preloader').hide();
             $('.loader').hide();
          }
        });
    
      
      // console.log($('.chat-conversation-box')[0].scrollHeight);
    
    });
    
    const ps = new PerfectScrollbar('.people', {
      suppressScrollX : true
    });

    //check if message read

    setInterval(function(){
      check_messages();
    },20000);
  
  })(jQuery);
  
  
  function callOnConnect() {
    var getCallStatusText = $('.overlay-phone-call .call-status');
    var getCallTimer = $('.overlay-phone-call .timer');
    var setCallStatusText = getCallStatusText.text('Connected');
    var setCallTimerDiv = getCallTimer.css('visibility', 'visible');
  }
  
  function videoCallOnConnect() {
    var getVideoCallingDiv = $('.overlay-video-call');
    var setVideoCallingImage = getVideoCallingDiv.addClass('onConnect');
    var getCallStatusText = $('.overlay-video-call .call-status');
    var getCallStatusImage = $('.overlay-video-call .calling-user-img');
    var getCallTimer = $('.overlay-video-call .timer');
    var setCallStatusText = getCallStatusText.text('Connected');
    var setVideoCallingImage = getCallStatusImage.css('display', 'none');
    var setVideoCallTimerDiv = getCallTimer.css('visibility', 'visible');
  }
  
  //get count of unread messages
  function get_unread_messages_count()
  {
      $('.user_unread_count').each(function(){
         var user_id=$(this).attr('user-id');
         var el=$(this);
         $.ajax({
           url:ajax_url("get_unread_messages_count/"+user_id),
           success:function(count)
           {
              if(count>0)
              {
                  el.text(count);
              }
              else{
                  el.text('');
              }
           }
         });
      });
  }
  
  
  //load more
  function load_more()
  {
      var user_id=$('.person.active').attr('user-id');
  
      var message_id=$('.first_message').val();
  
      $.ajax({
          url:ajax_url("load_more/"+user_id+"/"+message_id),
          type:"get",
          beforeSend:function(){
              $('.preloader').show();
              $('.loader').show();
          },
          success:function(messages){
              //get current user id
              current_user=$('#current_user').val();
              //reverse desc order to asc
              messages=messages.reverse();
              //assign first message
              if(messages.length>0)
              {
                  $('.first_message').val(messages[0].id);
              }
              //remove load more if no more
              if(messages.length<10)
              {
                  $('.load_more').remove();
              }
  
              var html='';
  
              messages.forEach(function(message){
              
                if(message.from==current_user)
                {
                  html+=`<div class="bubble me" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                  if(message.read)
                  {
                    html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;"></i>`;
                  }
                  else{
                    html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;"></i>`;
                  }
                  html+=`</div>`;
                }   
                else{
                 html+=`<div class="bubble you" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                 if(message.read)
                 {
                     html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;"></i>`;
                 }
                 else{
                     html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;"></i>`;
                 }
                 html+=`</div>`;
                }  
                  $(html).insertAfter( ".load_more" );            
              });
  
          },
          complete:function(){
              $('.preloader').hide();
              $('.loader').hide();
          }
      });
  
  }

//check if messages read
function check_messages()
{
    var user_id=$('.person.active').attr('user-id');

    if(user_id!=null)
    {
      $.ajax({
          url:ajax_url('get_my_messages/'+user_id),
          success:function(messages)
          {
            $('.active-chat .bubble').each(function(){
              var message_id=$(this).attr('message-id');

              messages.forEach((item)=>{
                if(item.id==message_id)
                {
                  if(item.read==true)
                  {
                    $(this).find('i').addClass('text-success');
                  }
                }
              });
             
            });
          }
      });

    }
    
}

//sync messages
function sync_messages()
{
  var user_id=$('.people .active').attr('user-id');
  
  if(user_id)
  {
    $.ajax({
        url:ajax_url('chat_unread/'+user_id),
        success:function(messages){
            if(messages.length>0)
            {
            var html='';
            messages.forEach(function(message){
                if(message.from==current_user)
                {
                    html+=`<div class="bubble me" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                    if(message.read)
                    {
                    html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;text-align:right"></i>`;
                    }
                    else{
                    html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;text-align:right"></i>`;
                    }
                    html+=`</div>`;
                }   
                else{
                    html+=`<div class="bubble you" message-id="`+message.id+`">`+message.message+`<br>`+`<span style="font-size:12px;" class="since">`+message.created_at+'</span>';
                    if(message.read)
                    {
                        html+=`<i class="fas fa-check-double text-success" style="font-size:12px;padding:3px;text-align:right"></i>`;
                    }
                    else{
                        html+=`<i class="fas fa-check-double" style="font-size:12px;padding:3px;text-align:right"></i>`;
                    }
                    html+=`</div>`;
                }  
            });
          
            $('#chat_'+user_id).append(html);

            $('.chat-conversation-box').animate({
                scrollTop: 0
            }, 1);
            $('.chat-conversation-box').animate({
            scrollTop: $('#chat_'+user_id).height()
            }, 1);
            }
      }
    });

  }
}
  
  