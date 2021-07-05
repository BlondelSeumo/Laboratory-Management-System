<div class="row">
    <div class="col-lg-4">
       <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                  <i class="fa fa-user"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="{{__('Patient Name')}}" name="name" id="name" @if(isset($patient)) value="{{$patient->name}}" @endif required>
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
                <input type="email" class="form-control" placeholder="{{__('Email Address')}}" name="email" id="email" @if(isset($patient)) value="{{$patient->email}}" @endif required>
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
                <input type="text" class="form-control" placeholder="{{__('Phone number')}}" name="phone" id="phone"  @if(isset($patient)) value="{{$patient->phone}}" @endif required>
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
                    <input type="text" class="form-control" placeholder="{{__('Address')}}" name="address" id="address" @if(isset($patient)) value="{{$patient->address}}" @endif required>
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
                        <i class="fas fa-mars"></i>
                      </span>
                    </div>
                    <select class="form-control" name="gender" placeholder="{{__('Gender')}}" id="gender" required>
                        <option value="" disabled selected>{{__('Select Gender')}}</option>
                        <option value="male"  @if(isset($patient)&&$patient['gender']=='male') selected @endif>{{__('Male')}}</option>
                        <option value="female"  @if(isset($patient)&&$patient['gender']=='female') selected @endif>{{__('Female')}}</option>
                    </select>
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
                    <input type="text" class="form-control datepicker" placeholder="{{__('Date of birth')}}" name="dob" required @if(isset($patient)) value="{{$patient['dob']}}" @endif readonly>
                </div>
            </div>
        </div>
    </div>
    
</div>
