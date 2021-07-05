@extends('layouts.app')

@section('title')
{{ __('Show home visit') }}
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fa fa-home"></i>
                    {{__('Home visits')}}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.visits.index')}}">{{ __('Home visits') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('Show home visit') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ __('Home visit details') }}</h3>
        
        <a href="{{route('admin.visits.create_tests',$visit['id'])}}" class="btn btn-primary btn-sm float-right">
            <i class="fa fa-flask"></i> {{__('Create group tests')}}
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
               <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                          <i class="fa fa-user"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" @if(isset($visit['patient'])) value="{{$visit['patient']['name']}}" @endif disabled>
                </div>
               </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-phone-alt"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control" @if(isset($visit['patient']))  value="{{$visit['patient']['phone']}}" @endif disabled>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-mars"></i>
                              </span>
                            </div>
                            <input type="text" @if(isset($visit['patient'])) value="{{$visit['patient']['gender']}}" @endif class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
        
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-map-marker-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control"  id="address" @if(isset($visit['patient'])) value="{{$visit['patient']['address']}}" @endif disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-envelope"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control" @if(isset($visit['patient'])) value="{{$visit['patient']['email']}}" @endif disabled>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-baby"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control" @if(isset($visit['patient'])) value="{{$visit['patient']['dob']}}" @endif disabled>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-clock"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control"  value="{{$visit['visit_date']}}" disabled>
                        </div>
                    </div>
                </div>
            </div>

        </div>        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
         <div class="card card-danger">
             <div class="card-header">
                 <h5 class="card-title">
                     <i  class="fas fa-map-marked-alt nav-icon"></i>
                     {{__('Location on map')}}
                 </h5>
             </div>
             <input type="hidden" name="lat" id="visit_lat" @if(isset($visit)) value="{{$visit['lat']}}" @endif>
             <input type="hidden" name="lng" id="visit_lng" @if(isset($visit)) value="{{$visit['lng']}}" @endif>
             <input type="hidden" name="zoom_level" id="zoom_level" @if(isset($visit)) value="{{$visit['zoom_level']}}" @endif>
             <div class="card-body">
                 <div id="map" style="min-height:500px"></div>
             </div>
         </div>
    </div>
</div>

@if(!empty($visit)&&!empty($visit['attach']))
<div class="row">
    <div class="col-lg-12">
        <div class="card card-danger">
            <div class="card-header">
                <h5 class="card-title">
                     <i  class="fas fa-file-pdf nav-icon"></i>
                    {{__('Attachment')}}
                </h5>
            </div>
            <div class="card-body">
                @if(!empty($visit)&&!empty($visit['attach']))
                    <a href="{{url('uploads/visits/'.$visit['attach'])}}" class="btn btn-danger">
                        <i class="fa fa-file-pdf"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
 
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{$api_keys['google_map']}}&callback=initMap&libraries=&v=weekly" defer></script>
    <script src="{{url('js/admin/visits.js')}}"></script>
@endsection