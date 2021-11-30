@extends('layouts.admin')

@section('title',"Thêm mới nhóm sản phẩm")

@section('content')
<form action="{{route('admin.nhomsanpham.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="ten">Tên nhóm sản phẩm</label>
        <input type="text" class="form-control" name="ten" id="ten" aria-describedby="helpId" placeholder="">
        @error('ten')
            <div class="help-text text-danger">{{$message}}</div>
        @enderror
    </div>


    <div class="form-group">
        <label for="mota">Mô tả</label>
        <textarea class="form-control" name="mota" id="mota" rows="5"></textarea>
    </div>

    {{-- <div class="form-group">
        <label for="file_upload">Ảnh</label>
        <input type="file" class="form-control-file" name="file_upload" id="file_upload" placeholder="" aria-describedby="fileHelpId">
    </div> --}}

    <div class="form-group">
        <label for="trangthai">Trạng thái</label>
        <select class="form-control" name="trangthai" id="trangthai">
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select>
    </div>

    <div class="form-group">
        <label for="uutien">Mức ưu tiên</label>
        <input type="text" class="form-control" name="uutien" id="uutien" aria-describedby="helpId" placeholder="">
        @error('uutien')
            <div class="help-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Thêm mới</button>
</form>
@endsection


