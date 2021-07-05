@extends('layouts.app')

@section('title')
{{ __('Edit Translation') }}
@endsection

@section('css')

@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fa fa-list"></i>
                    {{__('Edit Translation')}}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.translations.index')}}">{{__('Translations')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('Edit Translation') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            {{ __('Edit Translation') }}
        </h3>
    </div>
    <form action="{{route('admin.translations.update',$id)}}" method="POST">
    @csrf
    @method('put')
    <!-- /.card-header -->
    <div class="card-body">
            <div class="col-lg-12  p-0">
                <table  class="table table-striped table-hover table-bordered"  width="100%">
                    <thead>
                        <tr>
                            <th>{{ __('Key Word') }}</th>
                            <th>{{__('Translation')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($translations as $key=>$value)
                            <tr>
                                <td>
                                    {{$key}}
                                </td>
                                <td>
                                   <input type="text" name="trans[{{$key}}]" class="form-control" value="{{$value}}" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-check"></i> {{__('Save')}}
        </button>
    </div>
    </form>
</div>

@endsection
@section('scripts')
    <script src="{{url('js/admin/translations.js')}}"></script>
@endsection