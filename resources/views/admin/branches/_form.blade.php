<div class="row">
    <div class="col-lg-4">
       <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                    <i  class="fas fa-map-marked-alt nav-icon"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="{{__('Branch name')}}" name="name" id="name" @if(isset($branch)) value="{{$branch->name}}" @endif required>
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
                <input type="text" class="form-control" placeholder="{{__('Phone number')}}" name="phone" id="phone" @if(isset($branch)) value="{{$branch->phone}}" @endif required>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">
                    <i class="fas fa-map-marker-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="{{__('Address')}}" name="address" id="address" @if(isset($branch)) value="{{$branch->address}}" @endif required>
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
            <input type="hidden" name="lat" id="branch_lat" @if(isset($branch)) value="{{$branch['lat']}}" @endif>
            <input type="hidden" name="lng" id="branch_lng" @if(isset($branch)) value="{{$branch['lng']}}" @endif>
            <input type="hidden" name="zoom_level" id="zoom_level" @if(isset($branch)) value="{{$branch['zoom_level']}}" @endif>
            <div class="card-body">
                <div id="map" style="min-height:500px"></div>
            </div>
        </div>
   </div>
</div>
