<div class="row">
  <div class="col-lg-4">
     <div class="form-group">
      <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">
                <i class="fa fa-user"></i>
            </span>
          </div>
          <input type="text" class="form-control" placeholder="{{__('Doctor Name')}}" name="name" id="name" @if(isset($doctor)) value="{{$doctor->name}}" @endif required>
      </div>
     </div>
  </div>

  <div class="col-lg-4">
      <div class="form-group">
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  <i class="fas fa-envelope"></i>
                </span>
              </div>
              <input type="email" class="form-control" placeholder="{{__('Email Address')}}" name="email" id="email" @if(isset($doctor)) value="{{$doctor->email}}" @endif required>
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
            <input type="text" class="form-control" placeholder="{{__('Phone number')}}" name="phone" id="phone"  @if(isset($doctor)) value="{{$doctor->phone}}" @endif required>
        </div>
    </div>
  </div>

  <div class="col-lg-4">
      <div class="form-group">
          <div class="form-group">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                      <i class="fas fa-map-marker-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="{{__('Address')}}" name="address" id="address" @if(isset($doctor)) value="{{$doctor->address}}" @endif required>
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
                    <i class="fas fa-percentage"></i>
                  </span>
                </div>
                <input type="number" class="form-control" placeholder="{{__('Commission')}}" name="commission" id="commission" @if(isset($doctor)) value="{{$doctor->commission}}" @endif min="0" max="100" required>
            </div>
        </div>
    </div>
  </div>
  
  
</div>
