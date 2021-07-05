<div class="row">
    <div class="col-lg-3">
     <div class="form-group">
      <label for="category">{{__('Category')}}</label>
        
        <button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#category_modal">
            <i class="fa fa-info-circle"></i>
            {{__('Not Listed ?')}}
        </button>

        @if(isset($expense)&&isset($expense['category']))
          <input type="hidden" value="{{$expense['expense_category_id']}}" id="expense_category_id">
        @endif

        <select name="expense_category_id" id="category" class="form-control select2" required>
            <option value="" value=""></option>
            @if(isset($expense['category'])&&!$expense_categories->contains('id',$expense['expense_category_id']))
                <option value="{{$expense['category']['id']}}">{{$expense['category']['name']}}</option>
            @endif
            @foreach($expense_categories as $category)
                <option value="{{$category['id']}}">{{$category['name']}}</option>
            @endforeach
        </select>
     </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group">
         <label for="name">{{__('Date')}}</label>
         <input type="text" class="form-control" name="date" id="date" @if(isset($expense)) value="{{$expense->date}}" @endif readonly required>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group">
         <label for="name">{{__('Doctor')}}</label>
         <select class="form-control" name="doctor_id" id="doctor">
            @if(isset($expense)&&isset($expense['doctor']))
                <option value="{{$expense['doctor']['id']}}" selected>{{$expense['doctor']['name']}}</option>
            @endif
         </select>
        </div>
    </div>

    <div class="col-lg-3">
       <div class="form-group">
        <label for="amount">{{__('Amount')}}</label>
        <input type="number" class="form-control" name="amount" id="amount" min="0" @if(isset($expense)) value="{{$expense->amount}}" @endif required>
       </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="notes">{{__('Notes')}}</label>
            <textarea name="notes" id="notes" cols="30" rows="5" class="form-control" required>@if(isset($expense)){{$expense->notes}}@endif </textarea>
        </div>
    </div>
</div>

