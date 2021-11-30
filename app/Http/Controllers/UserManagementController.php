<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User::paginate(3);

        if ($key=request()->key){
            $data=User::where('name','like','%'.$key.'%')->paginate(3);
        }

        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
                "name" => 'required',
                "email" => 'required|unique:users',
                "password" => 'required',
                // "confirm_password" => 'required|same:password',
            ],
            [
                "name.required" => "Tên không được để trống",
                "email.required" => "Email không được để trống",
                "email.unique" => "Email không hợp lệ",
                "password.required" => "Mật khẩu không được để trống",
                // "comfirm_password.required" => "Nhập lại mật khẩu",
                // "comfirm_password.same" => "Nhập lại mật khẩu không chính xác",
            ]
        );
        $password = bcrypt($request->password);
        $request->merge(['password' => $password]);
        if (User::create($request->all())){
            return redirect()->route('admin.user.index')->with('success','Thêm mới thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                "name" => 'required',
                "email" => 'required|unique:users',
            ],
            [
                "name.required" => "Tên không được để trống",
                "email.required" => "Email không được để trống",
                // "email.unique" => "Email không hợp lệ",
            ]
        );

        if ($user->update($request->all())){
            return redirect()->route('admin.user.index')->with('success', 'Cập nhật bản ghi thành công!');
        }
        else {
            return redirect()->route('admin.user.index')->with('error', "Lỗi cập nhật bản ghi");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("admin.user.index")->with('success', "Xóa bản ghi thành công!");
    }
}
