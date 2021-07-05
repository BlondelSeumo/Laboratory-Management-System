<div class="row">
    <div class="col-lg-6">
     <div class="form-group">
      <label for="title">{{__('Title')}}</label>
      <input type="text" class="form-control" name="title" placeholder="{{__('Contract title')}}" id="title" @if(isset($contract)) value="{{$contract->title}}" @endif required>
     </div>
    </div>
    <div class="col-lg-6">
       <div class="form-group">
        <label for="discount">{{__('Discount')}} %</label>
        <input type="number" class="form-control" name="discount" id="discount" placeholder="{{__('Contract discount %')}}" min="0" max="100" @if(isset($contract)) value="{{$contract->discount}}" @endif required>
       </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
         <label for="description">{{__('Description')}}</label>
          <textarea name="description" id="description" cols="30" rows="10" class="form-control">@if(!empty($contract)){{$contract['description']}}@endif</textarea>
        </div>
     </div>
</div>
