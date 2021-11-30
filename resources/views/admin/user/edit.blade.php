@extends('layouts.admin')

@section('title', 'Cập nhật thông tin người dùng')

@section('content')
<form action="{{route('admin.user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-group">
        <label for="name">Tên</label>
        <input type="text" value="{{$user->name}}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
        @error('name')
            <div class="help-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" value="{{$user->email}}" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
        @error('email')
            <div class="help-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select class="form-control" name="status" id="status">
            <option value="1" @if ($user->status==1) selected='selected' @endif>Hoạt động</option>
            <option value="0" @if ($user->status==0) selected='selected' @endif>Không hoạt động</option>
        </select>
    </div>

    <div class="form-group">
        <label for="level">Level</label>
        <input type="number" value="{{$user->level}}" class="form-control" name="level" id="level" aria-describedby="helpId" placeholder="">
        @error('level')
            <div class="help-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@endsection


