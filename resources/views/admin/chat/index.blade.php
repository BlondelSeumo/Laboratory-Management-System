@extends('layouts.app')
@section('title')
  {{__('Chat')}}
@endsection
@section('css')
  <link rel="stylesheet" href="{{url('css/plugins.css')}}">
  <link rel="stylesheet" href="{{url('css/chat.css')}}">
@endsection
@section('content')
<input type="hidden"  id="current_user" value="{{auth()->guard('admin')->user()['id']}}">
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="chat-system">
            <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
            <div class="user-list-box">
                <div class="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" class="form-control" placeholder="{{__('Search')}}">
                </div>
                <div class="people ps ps--active-y">
                @foreach($users as $user)
                  <div class="person" data-chat="person{{$user['id']}}" user-id="{{$user['id']}}">
                      <div class="user-info">
                          <div class="f-head">
                              <img src="{{url('img/user-profile.png')}}" alt="avatar">
                          </div>
                          <div class="f-body">
                              <div class="meta-info">
                                  <span class="user-name" data-name="{{$user['name']}}">{{$user['name']}}</span>
                                  <span class="badge badge-danger float-right user_unread_count" user-id="{{$user['id']}}"></span>
                              </div>
                              <span class="preview">
                                  @if(\Cache::has('user-'.$user['id']))
                                      <i class="fas fa-circle text-success"></i> {{__('Online')}}
                                  @else 
                                      <i class="fas fa-circle text-danger"></i> {{__('Offline')}}
                                  @endif
                              </span>
                          </div>
                      </div>
                  </div>
                @endforeach
                
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 478px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 218px;"></div></div></div>
            </div>
            <div class="chat-box">
                <div class="chat-not-selected">
                    <p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>{{__('Click User To Chat')}}</p>
                </div>
                <div class="chat-box-inner">
                    <div class="chat-meta-user">
                        <div class="current-chat-user-name"><span><img src="assets/img/90x90.jpg" alt="dynamic-image"><span class="name"></span></span></div>
                    </div>
                    <div class="chat-conversation-box">
                        <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                          @foreach($users as $user)
                            <div class="chat" data-chat="person{{$user['id']}}" id="chat_{{$user['id']}}" user-id="user_{{$user['id']}}">
                                
                            </div>
                          @endforeach
                        </div>
                    </div>
                    <div class="chat-footer">
                        <div class="chat-input">
                            <form class="chat-form" action="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <input type="text" class="mail-write-box form-control" placeholder="{{__('Message')}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
  <script src="{{url('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <script src="{{url('js/admin/chat.js')}}"></script>
@endsection