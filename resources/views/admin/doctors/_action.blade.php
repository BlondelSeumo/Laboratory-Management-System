@can('edit_doctor')
    <a href="{{route('admin.doctors.edit',$doctor['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_doctor')
    <form method="POST" action="{{route('admin.doctors.destroy',$doctor['id'])}}" class="d-inline">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_doctor">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan