<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="category">{{__('Category')}}</label>
            <input type="text" placeholder="{{__('Expense category name')}}" name="name" id="category" class="form-control" @if(isset($expense_category)) value="{{$expense_category['name']}}" @endif required>
        </div>
    </div>
</div>

