@extends('layouts.app')

@section('title')
{{ __('Translation') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{url('plugins/swtich-netliva/css/netliva_switch.css')}}">
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fa fa-list"></i>
                    {{__('Translation')}}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('Translation') }}</li>
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
            {{ __('Translation') }}
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="col-lg-12  p-0">
                <table id="" class="table table-striped table-hover table-bordered"  width="100%">
                    <thead>
                        <tr>
                            <th>{{ __('Language') }}</th>
                            <th width="10px">{{ __('Active') }}</th>
                            <th width="10px">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($langs as $lang)
                            <tr>
                                <td>
                                    {{$lang['iso']}}
                                </td>
                                <td>
                                    @if($lang['active'])
                                        <input type="checkbox" class="change_lang_status" id="change_status_{{$lang['id']}}" lang-id='{{$lang['id']}}' checked netliva-switch data-active-text="{{__('Active')}}" data-passive-text=" {{__('Deactive')}}"/>
                                    @else 
                                        <input type="checkbox" class="change_lang_status" id="change_status_{{$lang['id']}}" lang-id='{{$lang['id']}}' netliva-switch data-active-text="{{__('Active')}}" data-passive-text="{{__('Deactive')}}"/>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.translations.edit',$lang['iso'])}}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <!-- /.card-body -->
</div>

@endsection
@section('scripts')
    <script src="{{url('js/admin/translations.js')}}"></script>
    <!-- Switch -->
    <script src="{{url('plugins/swtich-netliva/js/netliva_switch.js')}}"></script>
@endsection