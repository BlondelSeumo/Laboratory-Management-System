@extends('layouts.app')

@section('title')
    {{__('Our Branches')}}
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="fas fa-map-marked-alt nav-icon"></i>
            {{__('Our Branches')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('patient.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Our Branches')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="row">
    @foreach($branches as $branch)
    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">
                    {{$branch['name']}}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6>
                            <i class="fas fa-phone-alt"></i> 
                            <a href="tel:{{$branch['phone']}}">
                                {{$branch['phone']}}
                            </a>
                        </h6>
                        <h6>
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="http://maps.google.com/maps?q={{$branch['lat']}},{{$branch['lng']}}">
                             {{$branch['address']}}
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="http://maps.google.com/maps?q={{$branch['lat']}},{{$branch['lng']}}" class="btn btn-primary">
                  <i class="fas fa-map-marker-alt"></i>  {{__('View On Map')}}
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
    <script src="{{url('js/patient/branches.js')}}"></script>
@endsection