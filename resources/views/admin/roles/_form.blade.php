<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>{{__('Name')}}</label>
            <input type="text" class="form-control" name="name" placeholder="{{__('Role Name')}}" @if(isset($role))
                value="{{$role['name']}}" @endif required>
        </div>
    </div>
</div>

<div class="row">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title">
                {{__('Permissions')}}
            </h5>
            <button type="button" class="btn btn-danger btn-sm deselect_all_modules float-right">
                <i class="fa fa-times-circle"></i>
            </button>
    
            <button type="button" class="btn btn-primary btn-sm select_all_modules float-right mr-2">
                <i class="fa fa-check-square"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($modules as $module)
                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">{{$module['name']}}</h5>
                            <button type="button" class="btn btn-danger btn-sm deselect_module float-right">
                                <i class="fa fa-times-circle"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-sm  select_module float-right mr-2">
                                <i class="fas fa-check-square"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            @foreach($module['permissions'] as $permission)
                            <div class="row">
                                <div class="col-lg-9">
                                    <label for="{{$permission['key']}}">{{$permission['name']}}</label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch">
                                        <input type="checkbox" name="permissions[][permission_id]" value="{{$permission['id']}}"
                                            id="{{$permission['key']}}">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>