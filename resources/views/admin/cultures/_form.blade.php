<div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <label for="name">{{__('Name')}}</label>
        <input type="text" class="form-control" name="name" id="name" @if(isset($culture)) value="{{$culture->name}}" @endif required>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <label for="sample_type">{{__('Sample Type')}}</label>
        <input type="text" class="form-control" name="sample_type" id="sample_type" @if(isset($culture)) value="{{$culture->sample_type}}" @endif required>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
              <label for="price">{{__('Price')}}</label>
              <div class="input-group form-group mb-3">
              <input type="number" class="form-control" name="price" id="price" min="0" @if(isset($culture)) value="{{$culture->price}}" @endif required>
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
             <textarea name="precautions" id="precautions" rows="1" class="form-control" placeholder="{{__('Precautions')}}">@if(isset($culture)){{$culture['precautions']}}@endif</textarea>
        </div>
    </div>
    
</div>
