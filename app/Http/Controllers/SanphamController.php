<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use Illuminate\Http\Request;
use App\Models\Nhomsanpham;
use Illuminate\Support\Facades\File;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Sanpham::where('ten', 'like', '%'.$key.'%')->orderby('uutien','DESC')->paginate(5);
        }
        else {
            $data = Sanpham::orderby('uutien','DESC')->paginate(5);
        }
        return view('admin.sanpham.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhomsanphams=Nhomsanpham::orderby('ten')->where('trangthai',1)->select('id','ten')->get();
        return view('admin.sanpham.create', compact('nhomsanphams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "ten" => 'required|unique:sanpham',
                "gia" => 'required',
                "uutien" => 'required',
            ],
            [
                "ten.required" => "Cần nhập tên sản phẩm",
                "ten.unique" => "Tên sản phẩm không trùng nhau",
                "uutien.required" => "Cần nhập mức độ ưu tiên",
            ]
        );
        // if ($request->hasFile('file_upload')) {
        //     $file = $request->file_upload;
        //     $filename = time() . '-sp.' . $file->getClientOriginalExtension();

        //     $file->move(public_path('uploads'), $filename);

        //     $request->merge(["anh" => $filename]);
        //     // dd($filename);
        // }

        if(Sanpham::create($request->all())){
            return redirect()->route('admin.sanpham.index')->with('success', 'Thêm mới sản phẩm thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(Sanpham $sanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(Sanpham $sanpham)
    {
        $nhomsanphams=Nhomsanpham::orderby('ten')->where('trangthai',1)->select('id','ten')->get();
        return view('admin.sanpham.edit', ['sanpham'=>$sanpham, 'nhomsanphams'=>$nhomsanphams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sanpham $sanpham)
    {
        $request->validate(
            [
                "ten" => 'required|unique:nhomsanpham,ten,'.$sanpham->id,
                "uutien" => 'required',
                "gia" => 'required',
            ],
            [
                "ten.required" => "Cần nhập tên nhóm sản phẩm",
                "ten.unique" => "Tên nhóm sản phẩm không trùng nhau",
                "uutien.required" => "Cần nhập mức độ ưu tiên của nhóm sản phẩm",
                "gia.required" => "Cần nhập giá sản phẩm",
            ]
        );

        // $boldelete=false;
        // if ($request->hasFile('file_upload')){
        //     $file = $request->file_upload;
        //     $filename = time() . '-sp.' . $file->getClientOriginalExtension();

        //     $file->move(public_path('uploads'), $filename);

        //     $request->merge(["anh" => $filename]);-
        //     $boldelete=true;
        // }
        // else{
        //     $request->merge(["anh" => $sanpham->anh]);
        // }

        // if ($boldelete){
        //     File::delete(public_path('uploads') .'/' . $sanpham->anh);
        // }

        if ($sanpham->update($request->all())){
            return redirect()->route('admin.sanpham.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        else {
            return redirect()->route('admin.sanpham.index')->with('error', "Lỗi cập nhật bản ghi");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sanpham $sanpham)
    {
        if ($sanpham->details()->count()>0) {
            return redirect()->route("admin.sanpham.index")->with('error', "Không thể xóa sản phẩm này do đang có trong đơn hàng");
        } else {
            $sanpham->delete();
            return redirect()->route("admin.sanpham.index")->with('success', "Xóa bản ghi thành công!");
        }
    }
}
