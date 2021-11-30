@extends('layouts.admin')

@section('title', 'Thêm mới người dùng')

@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
            @error('name')
                <div class="help-text text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
            @error('email')
                <div class="help-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
            @error('password')
                <div class="help-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="comfirm_password">Confirm Password</label>
            <input type="text" class="form-control" name="comfirm_password" id="comfirm_password" aria-describedby="helpId" placeholder="">
            @error('comfirm_password')
                <div class="help-text text-danger">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select class="form-control" name="status" id="status">
                <option value="1">Hoạt động</option>
                <option value="0">Không hoạt động</option>
            </select>
        </div>

        <div class="form-group">
            <label for="level">Level</label>
            <input type="text" class="form-control" name="level" id="level" aria-describedby="helpId" placeholder="">
            @error('level')
                <div class="help-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection

