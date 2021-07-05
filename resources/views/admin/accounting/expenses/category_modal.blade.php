<div class="modal fade" id="category_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('New Expense Category')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="create_category_form" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="category_name">{{__('Category name')}}</label>
                  <input type="text" name="name" id="category_name" placeholder="{{__('Expense Category')}}" class="form-control" required> 
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Close')}}</button>
                <button type="submit" class="btn btn-primary save_category">{{__('Save')}}</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->