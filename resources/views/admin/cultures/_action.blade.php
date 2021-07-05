@can('edit_culture')
    <a href="{{route('admin.cultures.edit',$culture['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_culture')
    <form method="POST" action="{{route('admin.cultures.destroy',$culture['id'])}}" class="d-inline">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_culture">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan