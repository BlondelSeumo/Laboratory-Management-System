<div class="row">
    <div class="col-lg-3">
      <div class="form-group">
        <label for="name">{{__('Name')}}</label>
        <input type="text" class="form-control" name="name" id="name" @if(isset($test)) value="{{$test->name}}" @endif required>
      </div> 
    </div>
    <div class="col-lg-3">
      <div class="form-group">
        <label for="shortcut">{{__('Shortcut')}}</label>
        <input type="text" class="form-control" name="shortcut" id="shortcut" @if(isset($test)) value="{{$test->shortcut}}" @endif required>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="form-group">
        <label for="sample_type">{{__('Sample Type')}}</label>
        <input type="text" class="form-control" name="sample_type" id="sample_type" @if(isset($test)) value="{{$test->sample_type}}" @endif required>
      </div>
    </div>
    <div class="col-lg-3">
       <div class="form-group">
            <label for="price">{{__('Price')}}</label>
            <div class="input-group form-group mb-3">
                <input type="number" class="form-control" name="price" min="0" id="price" @if(isset($test)) value="{{$test->price}}" @endif required>
                <div class="input-group-append">
                <span class="input-group-text">
                    {{get_currency()}}
                </span>
                </div>
            </div>
       </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
             <label for="precautions">{{__('Precautions')}}</label>
             <textarea name="precautions" id="precautions" rows="3" class="form-control" placeholder="{{__('Precautions')}}">@if(isset($test)){{$test['precautions']}}@endif</textarea>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{__('Test Components')}}</h3>
                <ul class="list-style-none">
                    <li class="d-inline float-right">
                        <button type="button" class="btn btn-primary btn-sm add_component">
                            <i class="fa fa-plus"></i>
                            {{__('Component')}}
                        </button>
                    </li>
                    <li class="d-inline float-right mr-1">
                        <button type="button" class="btn btn-primary btn-sm  add_title">
                            <i class="fa fa-plus"></i>
                            {{__('Title')}}
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12" style="overflow-x: auto">
                        <table class="table table-striped table-bordered table-hover components" width="100%">
                            <thead class="btn-primary">
                                <th width="200px">{{__('Name')}}</th>
                                <th width="100px">{{__('Unit')}}</th>
                                <th width="200px">{{__('Result')}}</th>
                                <th width="200px">{{__('Reference Range')}}</th>
                                <th width="150px" class="text-center">{{__('Separated')}}</th>
                                <th width="10px" class="text-center">{{__('status')}}</th>
                                <th width="10px"></th>
                            </thead>
                            <tbody class="items">
                                @php 
                                  $count=0;
                                  $option_count=0;
                                @endphp
                                @if(isset($test))
                                    @foreach($test['components'] as $component)
                                        @php 
                                            $count++;
                                        @endphp
                                        <tr num="{{$count}}" test_id="{{$component['id']}}">
                                            @if($component['title'])
                                                <td colspan="6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="component[{{$count}}][title]" value="true">
                                                        <input type="hidden" name="component[{{$count}}][id]" value="{{$component['id']}}">
                                                        <input type="text" class="form-control" name="component[{{$count}}][name]" placeholder="{{__('Name')}}" value="{{$component['name']}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete_row">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="component[{{$count}}][id]" value="{{$component['id']}}">
                                                        <input type="text" class="form-control" name="component[{{$count}}][name]" placeholder="{{__('Name')}}" value="{{$component['name']}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="component[{{$count}}][unit]" placeholder="{{__('Unit')}}" value="{{$component['unit']}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul class="p-0 list-style-none">
                                                        <li>
                                                            <input class="select_type" value="text" type="radio" name="component[{{$count}}][type]" id="text_{{$count}}" @if($component['type']=='text') checked @endif required> <label for="text_{{$count}}">{{__('Text')}}</label>
                                                        </li>
                                                        <li>
                                                            <input class="select_type" value="select" type="radio" name="component[{{$count}}][type]" id="select_{{$count}}" @if($component['type']=='select') checked @endif required> <label for="select_{{$count}}">{{__('Select')}}</label>
                                                        </li>
                                                    </ul>
                                                    <div class="options">
                                                        @if($component['type']=='select')
                                                        <table width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('Option')}}</th>
                                                                    <th width="10px" class="text-center">
                                                                        <button type="button" class="btn btn-primary btn-sm add_option">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </th>
                                                                </tr>
                                                            </head>
                                                            <tbody>
                                                            @foreach($component['options'] as $option)
                                                                @php 
                                                                    $option_count++;
                                                                @endphp
                                                                <tr option_id="{{$option['id']}}">
                                                                    <td>
                                                                        <input type="text" name="component[{{$count}}][old_options][{{$option_count}}]" value="{{$option['name']}}" class="form-control" required>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-sm text-center delete_option">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="component[{{$count}}][reference_range]" placeholder="{{__('Reference Range')}}">{!!$component['reference_range']!!}</textarea>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="check_separated" num="{{$count}}" type="checkbox" name="component[{{$count}}][separated]" @if($component['separated']) checked @endif>
                                                    <div class="component_price">
                                                        @if($component['separated'])
                                                        <div class="card card-primary">
                                                            <div class="card-header">
                                                                <h5 class="card-title">
                                                                {{__('Price')}}
                                                                </h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="input-group form-group mb-3">
                                                                    <input type="number" class="form-control" name="component[{{$count}}][price]" value="{{$component['price']}}" min="0" class="price" required>
                                                                    <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        {{get_currency()}}
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input  type="checkbox" name="component[{{$count}}][status]" @if($component['status']) checked @endif>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete_row">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>

<input type="hidden" name="" id="count" value="{{$count}}"> 
<input type="hidden" name="" id="option_count" value="{{$option_count}}"> 