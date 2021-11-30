@extends('layouts.admin')

@section('title', 'Cập nhật sản phẩm')

@section('content')
    <form action="{{ route('admin.sanpham.update', $sanpham->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nhomsanphamid">Nhóm sản phẩm</label>
                    <select class="form-control" name="nhomsanphamid" id="nhomsanphamid">
                        @foreach ($nhomsanphams as $nsp)
                            <option value={{ $nsp->id }} @if ($sanpham->nhomsanphamid == $nsp->id) selected='selected' @endif>{{ $nsp->ten }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ten">Tên</label>
                    <input type="text" value="{{ $sanpham->ten }}" class="form-control" name="ten" id="ten"
                        aria-describedby="helpId" placeholder="">
                    @error('ten')
                        <div class="help-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <textarea class="form-control" name="mota" id="mota" rows="5">{{ $sanpham->mota }}</textarea>
                </div>

                <div class="form-group">
                    <label for="danhsachanh">Danh sách ảnh</label>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#model_list">
                        <i class="fa fa-folder-open"></i>
                    </button>
                    <!-- <input type="text" class="form-control" name="danhsachanh" id="danhsachanh" aria-describedby="helpId" placeholder="Danh sách ảnh"> -->
                    <input type="hidden" id="danhsachanh" name="danhsachanh" value="{{ $sanpham->danhsachanh }}">

                    <div class="row" id="show_danhsachanh"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="gia">Giá</label>
                    <input type="number" value="{{ $sanpham->gia }}" class="form-control" name="gia" id="gia"
                        aria-describedby="helpId" placeholder="Giá">
                    @error('gia')
                        <small class="text-help text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="giaban">Giá bán</label>
                    <input type="number" value="{{ $sanpham->giaban }}" class="form-control" name="giaban" id="giaban"
                        aria-describedby="helpId" placeholder="Giá bán">
                </div>

                {{-- <div class="form-group">
                    <label for="file_upload">Ảnh</label>
                    <img src="{{ url('uploads') }}/{{ $sanpham->anh }}" height="100" width="100" alt="">
                    <input type="file" class="form-control-file" name="file_upload" id="file_upload" placeholder=""
                        aria-describedby="fileHelpId">
                </div> --}}

                <div class="form-group">
                    <label for="anh">Ảnh</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="anh" id="anh" value="{{ $sanpham->anh }}" aria-describedby="helpId" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#image_list">
                                    <i class="fas fa-image"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <img src="" id="show_img" style="width: 20%">
                </div>

                <div class="form-group">
                    <label for="trangthai">Trạng thái</label>
                    <select class="form-control" name="trangthai" id="trangthai">
                        <option value="1" @if ($sanpham->trangthai == 1) selected='selected' @endif>Hoạt động</option>
                        <option value="0" @if ($sanpham->trangthai == 0) selected='selected' @endif>Không hoạt động</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="uutien">Mức ưu tiên</label>
                    <input type="number" value="{{ $sanpham->uutien }}" class="form-control" name="uutien" id="uutien"
                        aria-describedby="helpId" placeholder="">
                    @error('uutien')
                        <div class="help-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="model_list" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width:900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ url('file/dialog.php?field_id=danhsachanh') }}"
                        style="width:100%; height:500px; overflow-y: auto; border:none"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="image_list" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" rol e="document" style="max-width:900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ url('file/dialog.php?field_id=anh') }}"
                        style="width:100%; height:500px; overflow-y: auto; border:none"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('admin123') }}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('js')
    <!-- Summernote -->
    <script src="{{ url('admin123') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            // Summernote
            $('#mota').summernote({
                height: 200,
                placeholder: "Mô tả sản phẩm"
            })
        })

        function refresh_danhsachanh() {
            var _links = $('input#danhsachanh').val();
            try {
                var _image_list = JSON.parse(_links);
            } catch (error) {
                var _image_list = [_links];
            }
            var _html = '';
            for (let i in _image_list) {
                let _img = "{{ url('public/uploads') }}" + '/' + _image_list[i];
                _html += '<div class="col-sm-2">';
                _html += '<img src="' + _img + '" alt="" style="width:100px">';
                _html += '</div>'
            }

            $('#show_danhsachanh').html(_html);
        }

        $(function() {
            refresh_danhsachanh();
        });

        $("#model_list").on('hidden.bs.modal', event => {
            refresh_danhsachanh();
        });

// ----------------------------- Image -------------------------------------
        function refresh_anh() {
            var _link = $('input#anh').val();
            var _img = "{{url('public/uploads')}}" + '/' + _link;
            $('#show_img').attr('src', _img);
        }

        $(function() {
            refresh_anh();
        });

        $("#image_list").on('hidden.bs.modal', event => {
            refresh_anh();
        });

    </script>
@endsection
