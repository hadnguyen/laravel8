@extends('layouts.admin')

@section('title',"Danh sách người dùng")

@section('content')
    <div class="row my-2">
        <div class="col-md-8">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" name="key" value="{{request()->key}}" class="form-control" placeholder="Từ khóa" aria-describedby="helpId">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="text-right">
                <a class="btn btn-primary float-right" href="{{route('admin.user.create')}}" role="button">Thêm mới</a>
            </div>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Level</th>
                <th>Trạng thái</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if ($user->level==0)
                            <span class="badge badge-danger">Sys admin</span>
                        @elseif ($user->level==1)
                            <span class="badge badge-success">Người quản lí</span>
                        @else
                            <span class="badge badge-success">User</span>
                        @endif
                    </td>
                    <td>
                        @if($user->status==0)
                            <span class="badge badge-danger">Deleted</span>
                        @else
                            <span class="badge badge-success">Active</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <a name="" id="" class="btn btn-primary btn-sm" href="{{route('admin.user.edit',$user->id)}}" role="button">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a name="" id="" class="btn btn-danger btn-sm btnDelete" href="{{route('admin.user.destroy',$user->id)}}" role="button">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->appends(Request::all())->links() }}

    <form action="" method="POST" id="frmDelete">
        @csrf @method('DELETE')
    </form>
@endsection

@section('js')

<script>
    $(".btnDelete").click(function(ev){
        ev.preventDefault();
        let _href = $(this).attr('href');
        $("#frmDelete").attr('action', _href);
        if (confirm("Bạn muốn xóa bản ghi này không?")){
            $("#frmDelete").submit();
        }
    });
</script>

@endsection
