<div class="modal fade" id="patient_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Create Patient')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{route('ajax.create_patient')}}" method="POST" id="create_patient">
            @csrf
            <div class="text-danger" id="patient_modal_error"></div>
            <div class="modal-body" id="create_patient_inputs">
                <div class="row">
                    <div class="col-lg-4">
                       <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">
                                  <i class="fa fa-user"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control" placeholder="{{__('Patient Name')}}" name="name"  required>
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
                                <input type="email" class="form-control" placeholder="{{__('Email Address')}}" name="email" id="create_email"  required>
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
                                <input type="text" class="form-control" placeholder="{{__('Phone number')}}" name="phone"  id="create_phone" required>
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
                                    <input type="text" class="form-control" placeholder="{{__('Address')}}" name="address" id="create_address"  required>
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
                                    <select class="form-control" name="gender" placeholder="{{__('Gender')}}" id="create_gender" required>
                                        <option value="" disabled selected>{{__('Select Gender')}}</option>
                                        <option value="male" >{{__('Male')}}</option>
                                        <option value="female">{{__('Female')}}</option>
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
                                    <input type="text" class="form-control datepicker" placeholder="{{__('Date of birth')}}" name="dob" required id="create_dob">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>