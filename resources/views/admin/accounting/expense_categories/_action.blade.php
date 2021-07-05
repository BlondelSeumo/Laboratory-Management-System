@can('edit_expense_category')
    <a href="{{route('admin.expense_categories.edit',$expense_category['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_expense_category')
    <form method="POST" action="{{route('admin.expense_categories.destroy',$expense_category['id'])}}"  class="d-inline">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_expense_category">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan