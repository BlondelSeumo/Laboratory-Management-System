@can('edit_culture_option')
    <a href="{{route('admin.culture_options.edit',$culture_option['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_culture')
    <form method="POST" action="{{route('admin.culture_options.destroy',$culture_option['id'])}}" class="d-inline">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_culture_option">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan