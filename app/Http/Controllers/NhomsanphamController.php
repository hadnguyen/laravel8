<?php

namespace App\Http\Controllers;

use App\Models\Nhomsanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NhomsanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key) {
            $data = Nhomsanpham::where('ten', 'like', '%'.$key.'%')->orderby('uutien','DESC')->paginate(3);
        } else {
            $data = Nhomsanpham::orderby('uutien', 'DESC')->paginate(3);
        }
        return view('admin.nhomsanpham.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nhomsanpham.create');
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
                "ten" => 'required|unique:Nhomsanpham',
                "uutien" => 'required',
            ],
            [
                "ten.required" => "Cần nhập tên nhóm sản phẩm",
                "ten.unique" => "Tên nhóm sản phẩm không trùng nhau",
                "uutien.required" => "Cần nhập mức độ ưu tiên của nhóm sản phẩm",
            ]
        );
        if ($request->hasFile('file_upload')) {
            $file = $request->file_upload;
            $filename = time() . '-nsp.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);

            $request->merge(["anh" => $filename]);
            // dd($filename);
        }

        if (Nhomsanpham::create($request->all())){
            return redirect()->route('admin.nhomsanpham.index')->with('success','Thêm mới thành công');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function show(Nhomsanpham $nhomsanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(Nhomsanpham $nhomsanpham)
    {
        return view('admin.nhomsanpham.edit', compact('nhomsanpham')); //hoặc thay compact = ['nhomsanpham'=>$nhomsanpham]
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nhomsanpham $nhomsanpham)
    {
        $request->validate(
            [
                "ten" => 'required|unique:nhomsanpham,ten,'.$nhomsanpham->id,
                "uutien" => 'required',
            ],
            [
                "ten.required" => "Cần nhập tên nhóm sản phẩm",
                "ten.unique" => "Tên nhóm sản phẩm không trùng nhau",
                "uutien.required" => "Cần nhập mức độ ưu tiên của nhóm sản phẩm",
            ]
        );

        $boldelete=false;
        if ($request->hasFile('file_upload')){
            $file = $request->file_upload;
            $filename = time() . '-nsp.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);

            $request->merge(["anh" => $filename]);
            $boldelete=true;
        }
        else{
            $request->merge(["anh" => $nhomsanpham->anh]);
        }

        if ($boldelete){
            File::delete(public_path('uploads') .'/' . $nhomsanpham->anh);
        }

        if ($nhomsanpham->update($request->all())){
            return redirect()->route('admin.nhomsanpham.index')->with('success', 'Cập nhật bản ghi thành công!');
        }
        else {
            return redirect()->route('admin.nhomsanpham.index')->with('error', "Lỗi cập nhật bản ghi");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */

    public function destroy(Nhomsanpham $nhomsanpham){
        if ($nhomsanpham->sanphams()->count()>0) {
            return redirect()->route("admin.nhomsanpham.index")->with('error', "Xóa bản ghi không thành công do có chứa sản phẩm");
        } else {
            $nhomsanpham->delete();
            return redirect()->route("admin.nhomsanpham.index")->with('success', "Xóa bản ghi thành công!");
        }
    }
}
