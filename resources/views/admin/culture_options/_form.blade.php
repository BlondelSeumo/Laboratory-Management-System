<div class="card-body">
    <div class="row">
        <div class="col-lg-12">
           <div class="form-group">
            <label for="name">{{__('Name')}}</label>
            <input type="text" name="name" id="name" class="form-control" @if(isset($option)) value="{{$option['value']}}" @endif required>
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">
                        {{__('Options')}}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <th>{{__('Option')}}</th>
                                        <th width="10px">
                                            <button type="button" class="btn btn-sm btn-primary add_option">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $count=0;
                                    @endphp
                                    @if(isset($option))
                                        @foreach($option['childs'] as $child)
                                            @php 
                                                $count=$child['id'];
                                            @endphp
                                            <tr>
                                                <td>
                                                    <input type="text" name="old_option[{{$child['id']}}]" id="" placeholder="{{__('Option name')}}" value="{{$child['value']}}" class="form-control" required>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm delete_row" option_id="{{$child['id']}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <input type="hidden" name="" id="count_options" value="{{$count}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>