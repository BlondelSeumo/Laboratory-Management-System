@extends('layouts.app')

@section('title')
{{ __('Cultures Price List') }}
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
                    {{__('Cultures Price List')}}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('Cultures Price List') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ __('Cultures Table') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Tool -->
        <div class="row">
            <div class="col-lg-12">
                <div id="accordion">
                    <div class="card card-info">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed" aria-expanded="false">
                            <i class="fas fa-file-excel"></i>
                            {{__('Import / Export')}}
                        </a>
                        <div id="collapseOne" class="panel-collapse in collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="{{route('admin.prices.cultures_prices_export')}}" class="btn btn-success">
                                            <i class="fa fa-file-excel"></i>
                                            {{__('Export')}}
                                        </a>
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- import form -->
                                        <form action="{{route('admin.prices.cultures_prices_import')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <div class="card card-primary">
                                                <div class="card-header">
                                                    <h5 class="card-title">{{__('Import cultures')}}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="import">
                                                        <label class="custom-file-label" for="exampleInputFile">{{__('Choose file')}}</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check"></i>
                                                    {{__('Import')}}
                                                    </button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                        <!-- /import form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- \Tool -->

        <div class="row">
            <div class="col-lg-12  p-0">
                <form method="POST" action="{{route('admin.prices.cultures_submit')}}">
                @csrf
                    <table id=""  class="table table-striped table-hover table-bordered datatable"  width="100%">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>{{ __('Culture') }}</th>
                                <th width="200px">{{ __('Price') }}</th>
                            </tr>
                        </thead>
                        <!-- Analyses Prices Form -->
                    
                            <tbody>
                                @foreach($cultures as $culture)
                                    <tr>
                                        <td>{{$culture['id']}}</td>
                                        <td>{{$culture['name']}}</td>
                                        <td>
                                            <div class="input-group form-group mb-3">
                                                <input type="number" name="culture[{{$culture['id']}}]" class="form-control culture" value="{{$culture['price']}}" culture_id="{{$culture['id']}}" required>
                                                <div class="input-group-append">
                                                  <span class="input-group-text">
                                                      {{get_currency()}}
                                                  </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check"></i>  {{__('Save')}}
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        <!-- /Analyses Prices Form -->
                    </table>
                    @foreach($cultures as $culture)
                        <input type="hidden" name="culture[{{$culture['id']}}]" value="{{$culture['price']}}" id="culture_{{$culture['id']}}">
                    @endforeach
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

@endsection
@section('scripts')
<script>
    (function($){
       
        "use strict";
        
        //active
        $('#prices').addClass('menu-open');
        $('#prices_link').addClass('active');
        $('#cultures_prices').addClass('active');

        //change hidden cultures
        $(document).on('input','.culture',function(){
            var culture_id=$(this).attr('culture_id');
            var price=$(this).val();
            $('#culture_'+culture_id).val(price);
        });

    })(jQuery);
</script>
@endsection