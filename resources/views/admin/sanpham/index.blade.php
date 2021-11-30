@extends('layouts.admin')

@section('title','Sản phẩm')

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
                <a class="btn btn-primary" href="{{route('admin.sanpham.create')}}" role="button">Thêm mới</a>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Giá bán</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Mức ưu tiên</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td scope="row">{{$d->id}}</td>
                    <td>{{$d->ten}}</td>
                    <td>{{$d->gia}}</td>
                    <td>{{$d->giaban}}</td>
                    <td>
                        <img src="{{url('public/uploads')}}/{{$d->anh}}" width="60px" alt="">
                    </td>
                    <td>
                        @if ($d->trangthai==1)
                            <span class="badge badge-primary">Hoạt động</span>
                        @else
                            <span class="badge badge-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td>{{$d->uutien}}</td>
                    <td class="text-right">
                        <a name="" id="" class="btn btn-primary btn-sm" href="{{route('admin.sanpham.edit',$d->id)}}" role="button">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a name="" id="" class="btn btn-danger btn-sm btnDelete" href="{{route('admin.sanpham.destroy',$d->id)}}" role="button">
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
