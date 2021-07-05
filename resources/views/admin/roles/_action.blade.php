@can('edit_role')
    <a href="{{route('admin.roles.edit',$role['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_role')
    <form method="POST" action="{{route('admin.roles.destroy',$role['id'])}}" class="d-inline">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_role">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan