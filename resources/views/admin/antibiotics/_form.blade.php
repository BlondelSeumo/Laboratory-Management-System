<div class="row">
    <div class="col-lg-6">
     <div class="form-group">
      <label for="name">{{__('Name')}}</label>
      <input type="text" class="form-control" name="name" id="name" @if(isset($antibiotic)) value="{{$antibiotic->name}}" @endif required>
     </div>
    </div>
    <div class="col-lg-6">
       <div class="form-group">
        <label for="shortcut">{{__('Shortcut')}}</label>
        <input type="text" class="form-control" name="shortcut" id="shortcut" @if(isset($antibiotic)) value="{{$antibiotic->shortcut}}" @endif required>
       </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
             <label for="commercial_name">{{__('Commercial Name')}}</label>
             <textarea name="commercial_name" id="commercial_name" rows="1" class="form-control" placeholder="{{__('Commercial Name')}}">@if(isset($antibiotic)){{$antibiotic['commercial_name']}}@endif</textarea>
        </div>
    </div>
</div>
