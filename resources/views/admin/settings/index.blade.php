@extends('layouts.app')

@section('title')
{{__('Settings')}}
@endsection

@section('css')
  <!-- Colorpicker -->
  <link rel="stylesheet" href="{{url('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Switch -->
  <link rel="stylesheet" href="{{url('plugins/swtich-netliva/css/netliva_switch.css')}}">
@endsection

@section('breadcrumb')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          <i class="fa fa-cogs"></i>
          {{__('Settings')}}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
          <li class="breadcrumb-item active">{{__('Settings')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h5 class="card-title">
            {{__('Settings')}}
        </h5>
    </div>
    <div class="card-body pt-2">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
              <div class="nav flex-column nav-tabs  h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active"  data-toggle="pill" href="#general_settings" role="tab" aria-controls="general_settingse" aria-selected="true"><i class="fas fa-cog"></i> {{__('General')}}</a>
                <a class="nav-link"  data-toggle="pill" href="#emails_settings" role="tab" aria-controls="emails_settings" aria-selected="true"><i class="fas fa-envelope"></i> {{__('Emails')}}</a>
                <a class="nav-link"  data-toggle="pill" href="#reports_settings" role="tab" aria-controls="reports_settings" aria-selected="true"><i class="fas fa-file-alt"></i> {{__('Reports')}}</a>
                <a class="nav-link"  data-toggle="pill" href="#sms_settings" role="tab" aria-controls="sms_settings" aria-selected="true"><i class="fas fa-sms"></i> {{__('SMS')}}</a>
                <a class="nav-link"  data-toggle="pill" href="#whatsapp_settings" role="tab" aria-controls="whatsapp_settings" aria-selected="true"><i class="fab fa-whatsapp"></i> {{__('Whatsapp')}}</a>
                <a class="nav-link"  data-toggle="pill" href="#api_keys_settings" role="tab" aria-controls="api_keys_settings" aria-selected="true"><i class="fas fa-key"></i> {{__('Api Keys')}}</a>

              </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
              <div class="tab-content" id="vert-tabs-tabContent">
                
                <!-- General Settings -->
                <div class="tab-pane text-left fade show active" id="general_settings" role="tabpanel" aria-labelledby="general_settings">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h5 class="card-title">{{__('General Settings')}}</h5>
                            </div>
                            <form action="{{route('admin.settings.info_submit')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <div class="card-body">
                                <div class="card card-primary card-tabs">

                                    <div class="card-header p-0 pt-1">
                                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="false">{{__('General')}}</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="social-tab" data-toggle="pill" href="#social" role="tab" aria-controls="social" aria-selected="false">{{__('Social')}}</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="logos-tab" data-toggle="pill" href="#logos" role="tab" aria-controls="logos" aria-selected="true">{{__('Logos')}}</a>
                                        </li>
                                      </ul>
                                    </div>
                                    
                                    <div class="card-body">
                                      <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane active fade show" id="general" role="tabpanel" aria-labelledby="general-tab">
                                          <div class="row">
                                            <div class="col-lg-6">
                                              <div class="input-group form-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-file-signature"></i>
                                                  </span>
                                                </div>
                                                <input type="text" name="name" id="name" class="form-control" value="{{$settings['name']}}" required>
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                              <div class="input-group form-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-pound-sign"></i>
                                                  </span>
                                                </div>
                                                <select name="currency" id="currency" class="form-control select2">
                                                    @foreach($currencies as $currency)
                                                      <option value="{{$currency['iso']}}" @if($settings["currency"]==$currency['iso']) selected @endif>{{$currency['name']}}</option>
                                                    @endforeach
                                                </select>   
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                              <div class="input-group form-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-search-location"></i>
                                                  </span>
                                                </div>
                                                <input type="text" name="address" id="address" class="form-control" value="{{$settings['address']}}" required>
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                              <div class="input-group form-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-phone-square-alt"></i>
                                                  </span>
                                                </div>
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{$settings['phone']}}" required>
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                              <div class="input-group form-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-envelope-square"></i>
                                                  </span>
                                                </div>
                                                <input type="email" name="email" id="email" class="form-control" value="{{$settings['email']}}" required>
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                              <div class="input-group form-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-globe"></i>
                                                  </span>
                                                </div>
                                                <input type="text" name="website" id="website" class="form-control" value="{{$settings['website']}}" required>
                                              </div>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="form-group">
                                                <div class="input-group form-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="fa fa-copyright"></i>
                                                    </span>
                                                  </div>
                                                  <input type="text" name="footer" id="footer" placeholder="{{__('Footer')}}" class="form-control" value="{{$settings['footer']}}" required>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                                          <div class="row">
                                              <div class="col-lg-6">
                                                <div class="input-group form-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="fab fa-facebook"></i>
                                                    </span>
                                                  </div>
                                                  <input type="text" name="facebook" id="facebook" class="form-control" value="{{$settings['socials']['facebook']}}">
                                                </div>
                                              </div>
                                              <div class="col-lg-6">
                                                <div class="input-group form-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="fab fa-twitter"></i>
                                                    </span>
                                                  </div>
                                                  <input type="text" name="twitter" id="twitter" class="form-control" value="{{$settings['socials']['twitter']}}">
                                                </div>
                                              </div>
                                              <div class="col-lg-6">
                                                <div class="input-group form-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="fab fa-instagram"></i>
                                                    </span>
                                                  </div>
                                                  <input type="text" name="instagram" id="instagram" class="form-control" value="{{$settings['socials']['instagram']}}">
                                                </div>
                                              </div>
                                              <div class="col-lg-6">
                                                <div class="input-group form-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="fab fa-youtube"></i>
                                                    </span>
                                                  </div>
                                                  <input type="text" name="youtube" id="youtube" class="form-control" value="{{$settings['socials']['youtube']}}">
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="logos" role="tabpanel" aria-labelledby="logos-tab">
                                          <div class="row">
                                              <div class="col-lg-12">
                                                <div class="form-group">
                                                  <div class="input-group">
                                                    <div class="custom-file">
                                                      <input type="file" name="reports_logo" class="custom-file-input" id="reports_logo">
                                                      <label class="custom-file-label" for="reports_logo">{{__('Choose Report Logo')}} [100 X 100]</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                      <span class="input-group-text" id="">
                                                        <a href="{{url('img/reports_logo.png')}}" data-toggle="lightbox" data-title="Reports logo">
                                                          <i class="fa fa-image"></i>
                                                        </a>
                                                      </span>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-lg-12">
                                                <div class="form-group">
                                                  <div class="input-group">
                                                    <div class="custom-file">
                                                      <input type="file" name="logo" class="custom-file-input" id="logo">
                                                      <label class="custom-file-label" for="logo">{{__('Choose Logo')}} [100 X 100]</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                      <span class="input-group-text" id="">
                                                        <a href="{{url('img/logo.png')}}"  data-toggle="lightbox" data-title="Logo">
                                                          <i class="fa fa-image"></i>
                                                        </a>
                                                      </span>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                      
                                    <!-- /.card -->
                                </div>
                            </div>
                            <div class="card-footer">
                              <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
                <!-- \General Settings -->

                <!-- Email settings -->
                <div class="tab-pane text-left fade show" id="emails_settings" role="tabpanel" aria-labelledby="emails_settings">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">{{__('Email Settings')}}</h3>
                        </div>
                        <form action="{{route('admin.settings.emails_submit')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="host">{{__('Host')}}</label>
                                      <input type="text" name="host" id="host" value="{{$emails_settings['host']}}" class="form-control" required>
                                  </div>
                                </div>
                                <div class="col-lg-2">
                                  <div class="form-group">
                                    <label for="port">{{__('Port')}}</label>
                                    <input type="text" name="port" id="port" value="{{$emails_settings['port']}}" class="form-control" required>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                 <div class="form-group">
                                  <label for="username">{{__('Username')}}</label>
                                  <input type="text" name="username" id="username" value="{{$emails_settings['username']}}" class="form-control" required>
                                 </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="password">{{__('Password')}}</label>
                                    <input type="text" name="password" id="password" value="{{$emails_settings['password']}}" class="form-control" required>
                                  </div>
                                </div>
                                <div class="col-lg-1">
                                  <div class="form-group">
                                    <label for="encryption">{{__('Encryption')}}</label>
                                    <input type="text" name="encryption" id="encryption" value="{{$emails_settings['encryption']}}" class="form-control" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3">
                                    <div class="form-group">
                                      <label for="from_address">{{__('From Address')}}</label>
                                      <input type="email" name="from_address" id="from_address" value="{{$emails_settings['from_address']}}" class="form-control" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="form-group">
                                      <label for="from_name">{{__('From Name')}}</label>
                                      <input type="text" name="from_name" id="from_name" value="{{$emails_settings['from_name']}}" class="form-control" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                     <div class="form-group">
                                        <label for="header_color">{{__('Header background color')}}</label>
                                        <div class="input-group">
                                            <input id="header_color" type="text" class="form-control" name="header_color" value="{{$emails_settings['header_color']}}" required>
                                            <div class="input-group-append header_color">
                                                <span class="input-group-text"><i class="fas fa-square" style="color: {{$emails_settings['header_color']}}"></i></span>
                                            </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="footer_color">{{__('Footer background color')}}</label>
                                        <div class="input-group">
                                            <input id="footer_color" type="text" class="form-control" name="footer_color" value="{{$emails_settings['footer_color']}}" required>
                                            <div class="input-group-append footer_color">
                                                <span class="input-group-text"><i class="fas fa-square" style="color:{{$emails_settings['footer_color']}}"></i></span>
                                            </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-12">
                                      <div class="card card-primary card-tabs">
                                      <div class="card-header p-0 pt-1">
                                          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                          <li class="nav-item">
                                              <a class="nav-link active" id="patient_code_tab" data-toggle="pill" href="#patient_code" role="tab" aria-controls="patient_code" aria-selected="true">
                                              {{__('Patient Code')}}
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a class="nav-link" id="resetting_password_tab" data-toggle="pill" href="#resetting_password" role="tab" aria-controls="resetting_password" aria-selected="true">
                                              {{__('Resetting Password')}}
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a class="nav-link" id="tests_notification_tab" data-toggle="pill" href="#tests_notification" role="tab" aria-controls="tests_notification" aria-selected="true">
                                              {{__('Tests Notification')}}
                                              </a>
                                          </li>
                                          
                                          </ul>
                                      </div>
                                      <div class="card-body">
                                          <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade show active" id="patient_code" role="tabpanel" aria-labelledby="patient_code_tab">
                                              <div class="row">
                                                <div class="form-group">
                                                  <input name="patient_code[active]" type="checkbox" @if(!empty($emails_settings['patient_code'])&&$emails_settings['patient_code']['active']) checked @endif netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <p class="text-danger">{{__('Do not change variables')}}:<br>{patient_code} <br> {patient_name}</p>
                                              </div>
                                              <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="patient_code_subject">{{__('subject')}}</label>
                                                        <input type="text" id="patient_code_subject" class="form-control" name="patient_code[subject]" value="{{$emails_settings['patient_code']['subject']}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="patient_code_body">{{__('Body')}}</label>
                                                        <textarea class="form-control summernote" name="patient_code[body]" id="patient_code_body" cols="30" rows="10" required>{{$emails_settings['patient_code']['body']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>                  
                                            </div>
                                            <div class="tab-pane fade" id="resetting_password" role="tabpanel" aria-labelledby="resetting_password">
                                              <div class="row">
                                                <div class="form-group">
                                                  <input name="reset_password[active]" type="checkbox" @if(!empty($emails_settings['reset_password'])&&$emails_settings['reset_password']['active']) checked @endif netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                                </div>
                                              </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="reset_password_subject">{{__('subject')}}</label>
                                                            <input type="text" id="reset_password_subject" class="form-control" name="reset_password[subject]" value="{{$emails_settings['reset_password']['subject']}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="reset_password_body">{{__('Body')}}</label>
                                                            <textarea class="form-control summernote" name="reset_password[body]" id="reset_password_body" cols="30" rows="10" required>{{$emails_settings['reset_password']['body']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tests_notification" role="tabpanel" aria-labelledby="tests_notification">
                                              <div class="row">
                                                <div class="form-group">
                                                  <input name="tests_notification[active]" type="checkbox" @if(!empty($emails_settings['tests_notification'])&&$emails_settings['tests_notification']['active']) checked @endif netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <p class="text-danger">{{__('Do not change variables')}}:<br>{patient_code} <br> {patient_name}</p>
                                              </div>
                                              <div class="row">
                                                  <div class="col-lg-12">
                                                      <div class="form-group">
                                                          <label for="tests_notification_subject">{{__('subject')}}</label>
                                                          <input type="text" id="tests_notification_subject" class="form-control" name="tests_notification[subject]" value="{{$emails_settings['tests_notification']['subject']}}" required>
                                                      </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                      <div class="form-group">
                                                          <label for="tests_notification_body">{{__('Body')}}</label>
                                                          <textarea class="form-control summernote" name="tests_notification[body]" id="tests_notification_body" cols="30" rows="10" required>{{$emails_settings['tests_notification']['body']}}</textarea>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          </div>
                                      </div>
                                      <!-- /.card -->
                                      </div>
                                  
                                  </div>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            <button class="btn btn-primary"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- \Email Settings -->

                <!-- Reports settings -->
                <div class="tab-pane text-left fade show" id="reports_settings" role="tabpanel" aria-labelledby="reports_settings">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">{{__('Reports Settings')}}</h3>
                        </div>
                        <form action="{{route('admin.settings.reports_submit')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="show_header" id="show_header" @if($reports_settings['show_header']) checked @endif>
                                            <label for="show_header"><i class="fa fa-arrow-up"></i> {{__('Show Header')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="show_footer" id="show_footer" @if($reports_settings['show_footer']) checked @endif>
                                            <label for="show_footer"><i class="fas fa-arrow-down"></i> {{__('Show Footer')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="show_signature" id="show_signature" @if($reports_settings['show_signature']) checked @endif>
                                            <label for="show_signature"><i class="fas fa-signature"></i> {{__('Show signature')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-3">
                                        <label for="margin-top"><i class="fa fa-arrow-up"></i> {{__('Margin top')}}</label>
                                        <input type="number" min="0"  id="margin-top" name="margin-top"class="form-control" value="{{$reports_settings['margin-top']}}" required>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="margin-right"><i class="fa fa-arrow-right"></i> {{__('Margin right')}}</label>
                                        <input type="number" min="0" id="margin-right" name="margin-right"  class="form-control" value="{{$reports_settings['margin-right']}}"  required>                                        
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="margin-bottom"><i class="fa fa-arrow-down"></i> {{__('Margin bottom')}}</label>
                                        <input type="number" min="0" name="margin-bottom" id="margin-bottom" class="form-control" value="{{$reports_settings['margin-bottom']}}"  required>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="margin-left"><i class="fa fa-arrow-left"></i> {{__('Margin left')}}</label>
                                        <input type="number" min="0"  id="margin-left" name="margin-left" class="form-control" value="{{$reports_settings['margin-left']}}"  required>
                                    </div>

                                </div>

                                <div class="row mt-3">

                                  <div class="col-lg-3">
                                    <label for="content-margin-top"><i class="fa fa-arrow-up"></i> {{__('Content margin top')}}</label>
                                    <input type="number" min="0"  id="content-margin-top" name="content-margin-top" class="form-control" value="{{$reports_settings['content-margin-top']}}"  required>
                                  </div>

                                  <div class="col-lg-3">
                                      <label for="content-margin-bottom"><i class="fa fa-arrow-down"></i> {{__('Content margin bottom')}}</label>
                                      <input type="number" min="0"  id="content-margin-bottom" name="content-margin-bottom" class="form-control" value="{{$reports_settings['content-margin-bottom']}}"  required>
                                  </div>

                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Branch name')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="branch_name_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="branch_name_color" type="text" class="form-control color_input" name="branch_name[color]" value="{{$reports_settings['branch_name']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['branch_name']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-4">
                                            <label for="branch_name_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="branch_name[font-family]" id="branch_name_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>

                                          <div class="col-lg-4">
                                            <label for="branch_name_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="branch_name[font-size]" id="branch_name_font_size" min="1" value="{{$reports_settings['branch_name']['font-size']}}" required>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Branch info')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="branch_info_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="branch_info_color" type="text" class="form-control color_input" name="branch_info[color]" value="{{$reports_settings['branch_info']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['branch_info']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-4">
                                            <label for="branch_info_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="branch_info[font-family]" id="branch_info_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>

                                          <div class="col-lg-4">
                                            <label for="branch_info_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="branch_info[font-size]" id="branch_info_font_size" min="1" value="{{$reports_settings['branch_info']['font-size']}}" required>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Patient title')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="patient_title_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="patient_title_color" type="text" class="form-control color_input" name="patient_title[color]" value="{{$reports_settings['patient_title']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['patient_title']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-4">
                                            <label for="patient_title_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="patient_title[font-family]" id="patient_title_font_family" required>
                                                @include('admin.settings.fonts')
                                            </select>
                                          </div>

                                          <div class="col-lg-4">
                                            <label for="patient_title_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="patient_title[font-size]" id="patient_title_font_size" min="1" value="{{$reports_settings['patient_title']['font-size']}}" required>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Patient data')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="patient_data_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="patient_data_color" type="text" class="form-control color_input" name="patient_data[color]" value="{{$reports_settings['patient_data']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['patient_data']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="patient_data_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="patient_data[font-family]" id="patient_data_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="patient_data_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="patient_data[font-size]" id="patient_data_font_size" min="1" value="{{$reports_settings['patient_data']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Test title')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="test_title_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="test_title_color" type="text" class="form-control color_input" name="test_title[color]" value="{{$reports_settings['test_title']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['test_title']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="test_title_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="test_title[font-family]" id="test_title_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="test_title_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="test_title[font-size]" id="test_title_font_size" min="1" value="{{$reports_settings['test_title']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Test name')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="test_name_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="test_name_color" type="text" class="form-control color_input" name="test_name[color]" value="{{$reports_settings['test_name']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['test_name']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="test_name_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="test_name[font-family]" id="test_name_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="test_name_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="test_name[font-size]" id="test_name_font_size" min="1" value="{{$reports_settings['test_name']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Test head')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="test_head_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="test_head_color" type="text" class="form-control color_input" name="test_head[color]" value="{{$reports_settings['test_head']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['test_head']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="test_head_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="test_head[font-family]" id="test_head_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="test_head_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="test_head[font-size]" id="test_head_font_size" min="1" value="{{$reports_settings['test_head']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Result')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="result_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="result_color" type="text" class="form-control color_input" name="result[color]" value="{{$reports_settings['result']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['result']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="result_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="result[font-family]" id="result_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="result_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="result[font-size]" id="result_font_size" min="1" value="{{$reports_settings['result']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Test unit')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="unit_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="unit_color" type="text" class="form-control color_input" name="unit[color]" value="{{$reports_settings['unit']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['unit']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="unit_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="unit[font-family]" id="unit_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="unit_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="unit[font-size]" id="unit_font_size" min="1" value="{{$reports_settings['unit']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Test reference range')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="reference_range_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="reference_range_color" type="text" class="form-control color_input" name="reference_range[color]" value="{{$reports_settings['reference_range']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['reference_range']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="reference_range_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="reference_range[font-family]" id="reference_range_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="reference_range_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="reference_range[font-size]" id="reference_range_font_size" min="1" value="{{$reports_settings['reference_range']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Test status')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="status_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="status_color" type="text" class="form-control color_input" name="status[color]" value="{{$reports_settings['status']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['status']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="status_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="status[font-family]" id="status_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="status_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="status[font-size]" id="status_font_size" min="1" value="{{$reports_settings['status']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Test comment')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="comment_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="comment_color" type="text" class="form-control color_input" name="comment[color]" value="{{$reports_settings['comment']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['comment']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="comment_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="comment[font-family]" id="comment_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="comment_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="comment[font-size]" id="comment_font_size" min="1" value="{{$reports_settings['comment']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Report signature')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="signature_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="signature_color" type="text" class="form-control color_input" name="signature[color]" value="{{$reports_settings['signature']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['signature']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="signature_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="signature[font-family]" id="signature_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="signature_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="signature[font-size]" id="signature_font_size" min="1" value="{{$reports_settings['signature']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Antibiotic name')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="antibiotic_name_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="antibiotic_name_color" type="text" class="form-control color_input" name="antibiotic_name[color]" value="{{$reports_settings['antibiotic_name']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['antibiotic_name']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="antibiotic_name_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="antibiotic_name[font-family]" id="antibiotic_name_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="antibiotic_name_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="antibiotic_name[font-size]" id="antibiotic_name_font_size" min="1" value="{{$reports_settings['antibiotic_name']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Antibiotic sensitivity')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="sensitivity_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="sensitivity_color" type="text" class="form-control color_input" name="sensitivity[color]" value="{{$reports_settings['sensitivity']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['sensitivity']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="sensitivity_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="sensitivity[font-family]" id="sensitivity_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="sensitivity_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="sensitivity[font-size]" id="sensitivity_font_size" min="1" value="{{$reports_settings['sensitivity']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>
                                
                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h5 class="card-title">
                                            {{__('Antibiotic commercial name')}}
                                        </h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="form-group">
                                              <label for="commercial_name_color">{{__('Color')}}</label>
                                              <div class="input-group">
                                                  <input id="commercial_name_color" type="text" class="form-control color_input" name="commercial_name[color]" value="{{$reports_settings['commercial_name']['color']}}" required>
                                                  <div class="input-group-append color_tool">
                                                      <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['commercial_name']['color']}}"></i></span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="commercial_name_font_family">{{__('Font type')}}</label>
                                            <select class="form-control" name="commercial_name[font-family]" id="commercial_name_font_family" required>
                                              @include('admin.settings.fonts')
                                            </select>
                                          </div>
                              
                                          <div class="col-lg-4">
                                            <label for="commercial_name_font_size">{{__('Font size')}}</label>
                                            <input type="number" class="form-control" name="commercial_name[font-size]" id="commercial_name_font_size" min="1" value="{{$reports_settings['commercial_name']['font-size']}}" required>
                                          </div>
                              
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mt-3">
                                      <div class="card card-primary">
                                        <div class="card-header">
                                          <h5 class="card-title">
                                            <label for="report_footer">{{__('Footer')}}</label>
                                          </h5>
                                        </div>
                                        <div class="card-body">
                                          <div class="row">

                                              <div class="col-lg-12">
                                                
                                                <div class="row">

                                                  <div class="col-lg-3">
                                                    <div class="form-group">
                                                      <label for="report_footer_color">{{__('Color')}}</label>
                                                      <div class="input-group">
                                                          <input id="report_footer_color" type="text" class="form-control color_input" name="report_footer[color]" value="{{$reports_settings['report_footer']['color']}}" required>
                                                          <div class="input-group-append color_tool">
                                                              <span class="input-group-text"><i class="fas fa-square" style="color: {{$reports_settings['report_footer']['color']}}"></i></span>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                      
                                                  <div class="col-lg-3">
                                                    <label for="report_footer_font_family">{{__('Font type')}}</label>
                                                    <select class="form-control" name="report_footer[font-family]" id="report_footer_font_family" required>
                                                      @include('admin.settings.fonts')
                                                    </select>
                                                  </div>
                                      
                                                  <div class="col-lg-3">
                                                    <label for="report_footer_font_size">{{__('Font size')}}</label>
                                                    <input type="number" class="form-control" name="report_footer[font-size]" id="report_footer_font_size" min="1" value="{{$reports_settings['report_footer']['font-size']}}" required>
                                                  </div>

                                                  <div class="col-lg-3">
                                                    <label for="report_footer_text_align">{{__('Align')}}</label>
                                                    <select class="form-control" name="report_footer[text-align]" id="report_footer_text_align" required>
                                                      <option value="center" @if($reports_settings['report_footer']['font-size']=='center') selected @endif>{{__('Center')}}</option>
                                                      <option value="left" @if($reports_settings['report_footer']['font-size']=='center') selected @endif>{{__('Left')}}</option>
                                                      <option value="right" @if($reports_settings['report_footer']['font-size']=='center') selected @endif>{{__('Right')}}</option>
                                                    </select>
                                                  </div>
                                                </div>

                                              </div>

                                              <div class="col-lg-12">
                                                <div class="form-group">
                                                  <textarea name="footer" id="report_footer" cols="30" rows="5" class="form-control">{{$reports_settings['footer']}}</textarea>
                                                </div>
                                              </div>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                        
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-primary"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- \Reports Settings -->

                <!-- sms settings -->
                <div class="tab-pane text-left fade show" id="sms_settings" role="tabpanel" aria-labelledby="sms_settings">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">{{__('SMS Settings')}}</h3>
                         
                        </div>
                        <form action="{{route('admin.settings.sms_submit')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12 mb-3">
                                    <h4 class="text-center">{{__('Twilio Api')}}</h4>
                                  </div>
                                </div>
                               <div class="row">
                                 <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="sid">{{__('SID')}}</label>
                                    <input type="text" name="sid" id="sid" class="form-control" value="{{$sms_settings['sid']}}" required>
                                  </div>
                                 </div>
                                 <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="token">{{__('Token')}}</label>
                                    <input type="text" name="token" id="token" class="form-control" value="{{$sms_settings['token']}}" required>
                                  </div>
                                 </div>
                                 <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="from">{{__('From Number')}}</label>
                                    <input type="text" name="from" id="from" class="form-control" value="{{$sms_settings['from']}}" required>
                                  </div>
                                 </div>
                               </div>
                               <hr>
                               <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                          <li class="nav-item">
                                              <a class="nav-link active" id="patient_code_tab" data-toggle="pill" href="#sms_patient_code_tab" role="tab" aria-controls="patient_code" aria-selected="true">
                                              {{__('Patient Code')}}
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a class="nav-link" id="tests_notification_tab" data-toggle="pill" href="#sms_tests_notification_tab" role="tab" aria-controls="tests_notification" aria-selected="true">
                                                {{__('Tests Notification')}}
                                              </a>
                                          </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                          <div class="tab-pane fade show active" id="sms_patient_code_tab" role="tabpanel" aria-labelledby="patient_code_tab">
                                              <div class="row">
                                                <div class="form-group">
                                                  <input name="patient_code[active]" type="checkbox" @if($sms_settings['patient_code']['active']) checked @endif netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <p class="text-danger">{{__('Do not change variables')}}:<br>{patient_name}<br> {patient_code}</p>
                                                        <label for="sms_patient_code_body">{{__('Message')}}</label>
                                                        <textarea class="form-control" name="patient_code[message]" id="sms_patient_code_body" cols="30" rows="3" required>{{$sms_settings['patient_code']['message']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>                  
                                          </div>
                                          <div class="tab-pane fade show" id="sms_tests_notification_tab" role="tabpanel" aria-labelledby="tests_notification_tab">
                                            <div class="row">
                                              <div class="form-group">
                                                <input name="tests_notification[active]" type="checkbox" @if($sms_settings['tests_notification']['active']) checked @endif netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                              </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <p class="text-danger">{{__('Do not change variables')}}: <br>{patient_name} <br> {patient_code}</p>
                                                        <label for="sms_tests_notification_body">{{__('Message')}}</label>
                                                        <textarea class="form-control" name="tests_notification[message]" id="sms_tests_notification_body" cols="30" rows="3" required>{{$sms_settings['tests_notification']['message']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>                  
                                          </div>
                                          
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                    </div>
                                
                                </div>
                            </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-primary"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- \sms Settings -->

                <!-- whatsapp settings -->
                <div class="tab-pane text-left fade show" id="whatsapp_settings" role="tabpanel" aria-labelledby="whatsapp_settings">
                  <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Whatsapp {{__('Settings')}}</h3>
                      </div>
                      <form action="{{route('admin.settings.whatsapp_submit')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                             <div class="row">
                              <div class="col-lg-12">
                                  <div class="card card-primary card-tabs">
                                  <div class="card-header p-0 pt-1">
                                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="whatsapp_receipt_link" data-toggle="pill" href="#whatsapp_receipt_tab" role="tab" aria-controls="whatsapp_receipt_tab" aria-selected="true">
                                            {{__('Receipt link')}}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="whatsapp_report_link" data-toggle="pill" href="#whatsapp_report_tab" role="tab" aria-controls="whatsapp_report_tab" aria-selected="true">
                                              {{__('Report link')}}
                                            </a>
                                        </li>
                                      </ul>
                                  </div>
                                  <div class="card-body">
                                      <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="whatsapp_receipt_tab" role="tabpanel" aria-labelledby="whatsapp_receipt_tab">
                                            <div class="row">
                                              <div class="form-group">
                                                <input name="receipt[active]" type="checkbox" @if($whatsapp_settings['receipt']['active']) checked @endif netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-lg-12">
                                                  <div class="form-group">
                                                      <p class="text-danger">{{__('Do not change variables')}}:<br>{patient_name}<br> {receipt_link}</p>
                                                      <label for="whatsapp_receipt_body">{{__('Message')}}</label>
                                                      <textarea class="form-control" name="receipt[message]" id="whatsapp_receipt_body" cols="30" rows="3" required>{{$whatsapp_settings['receipt']['message']}}</textarea>
                                                  </div>
                                              </div>
                                          </div>                  
                                        </div>
                                        <div class="tab-pane fade show" id="whatsapp_report_tab" role="tabpanel" aria-labelledby="whatsapp_report_tab">
                                          <div class="row">
                                            <div class="form-group">
                                              <input name="report[active]" type="checkbox" @if($whatsapp_settings['report']['active']) checked @endif netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                            </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-lg-12">
                                                  <div class="form-group">
                                                      <p class="text-danger">{{__('Do not change variables')}}: <br>{patient_name} <br> {report_link}</p>
                                                      <label for="whatsapp_report_body">{{__('Message')}}</label>
                                                      <textarea class="form-control" name="report[message]" id="whatsapp_report_body" cols="30" rows="3" required>{{$whatsapp_settings['report']['message']}}</textarea>
                                                  </div>
                                              </div>
                                          </div>                  
                                        </div>
                                        
                                      </div>
                                  </div>
                                  <!-- /.card -->
                                  </div>
                              
                              </div>
                          </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <button class="btn btn-primary"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                          </div>
                      </form>
                  </div>
                </div>
                <!-- \whatsapp Settings -->

                <!-- Api keys Settings -->
                <div class="tab-pane text-left fade show" id="api_keys_settings" role="tabpanel" aria-labelledby="api_keys_settings">
                      <div class="card card-primary">
                          <div class="card-header">
                              <h5 class="card-title">{{__('Api Keys Settings')}}</h5>
                          </div>
                          <form action="{{route('admin.settings.api_keys_submit')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <label for="google_map"> <i class="fas fa-map-marker-alt"></i> {{__('Google maps')}}</label>
                                <input type="text" class="form-control" id="google_map" name="google_map" placeholder="{{__('Google map key')}}" value="{{$api_keys_settings['google_map']}}">
                            </div>
                            <div class="card-footer">
                              <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                            </div>
                        </form>
                      </div>
              </div>
              <!-- \Api Keys Settings -->

            </div>
          </div>
    </div>
</div>

@endsection


@section('scripts')
    <!-- Colorpicker -->
    <script src="{{url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- Switch -->
    <script src="{{url('plugins/swtich-netliva/js/netliva_switch.js')}}"></script>
    <script src="{{url('js/admin/settings.js')}}"></script>
    <script src="{{url('plugins/ekko-lightbox/ekko-lightbox.js')}}"></script>

    <script>
      $(document).ready(function(){
        $('#branch_name_font_family').val('{{$reports_settings["branch_name"]["font-family"]}}');
        $('#branch_info_font_family').val('{{$reports_settings["branch_info"]["font-family"]}}');
        $('#patient_title_font_family').val('{{$reports_settings["patient_title"]["font-family"]}}');
        $('#patient_data_font_family').val('{{$reports_settings["patient_data"]["font-family"]}}');
        $('#test_title_font_family').val('{{$reports_settings["test_title"]["font-family"]}}');
        $('#test_name_font_family').val('{{$reports_settings["test_name"]["font-family"]}}');
        $('#test_head_font_family').val('{{$reports_settings["test_head"]["font-family"]}}');
        $('#result_font_family').val('{{$reports_settings["result"]["font-family"]}}');
        $('#unit_font_family').val('{{$reports_settings["unit"]["font-family"]}}');
        $('#reference_range_font_family').val('{{$reports_settings["reference_range"]["font-family"]}}');
        $('#status_font_family').val('{{$reports_settings["status"]["font-family"]}}');
        $('#comment_font_family').val('{{$reports_settings["comment"]["font-family"]}}');
        $('#signature_font_family').val('{{$reports_settings["signature"]["font-family"]}}');
        $('#antibiotic_name_font_family').val('{{$reports_settings["antibiotic_name"]["font-family"]}}');
        $('#sensitivity_font_family').val('{{$reports_settings["sensitivity"]["font-family"]}}');
        $('#commercial_name_font_family').val('{{$reports_settings["commercial_name"]["font-family"]}}');
        $('#report_footer_font_family').val('{{$reports_settings["report_footer"]["font-family"]}}');
      });
    </script>
@endsection