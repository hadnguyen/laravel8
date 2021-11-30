@extends('layouts.admin')

@section('title','Cập nhật nhóm sản phẩm')

@section('content')
<form action="{{route('admin.nhomsanpham.update', $nhomsanpham->id)}}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-group">
        <label for="ten">Tên</label>
        <input type="text" value="{{$nhomsanpham->ten}}" class="form-control" name="ten" id="ten" aria-describedby="helpId" placeholder="">
        @error('ten')
            <div class="help-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="mota">Mô tả</label>
        <textarea class="form-control" name="mota" id="mota" rows="5">{{$nhomsanpham->mota}}</textarea>
    </div>

    {{-- <div class="form-group">
        <label for="file_upload">Ảnh</label>
        <img src="{{url('uploads')}}/{{$nhomsanpham->anh}}" height="100" width="100" alt="">
        <input type="file" class="form-control-file" name="file_upload" id="file_upload" placeholder="" aria-describedby="fileHelpId">
    </div> --}}

    <div class="form-group">
        <label for="trangthai">Trạng thái</label>
        <select class="form-control" name="trangthai" id="trangthai">
            <option value="1" @if ($nhomsanpham->trangthai==1) selected='selected' @endif>Hoạt động</option>
            <option value="0" @if ($nhomsanpham->trangthai==0) selected='selected' @endif>Không hoạt động</option>
        </select>
    </div>

    <div class="form-group">
        <label for="uutien">Mức ưu tiên</label>
        <input type="number" value="{{$nhomsanpham->uutien}}" class="form-control" name="uutien" id="uutien" aria-describedby="helpId" placeholder="">
        @error('uutien')
            <div class="help-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@endsection


