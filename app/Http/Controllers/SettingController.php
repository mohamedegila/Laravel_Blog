<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $adminId = session('adminData')->id;



        $settings = Admin::select(
            'user_auto',
            'recent_limit',
            'popular_limit',
            'comment_auto',
            'recent_comment_limit'
        )
        ->where('id', $adminId)->first();

        return view("Admin.setting.index", ['title'=>"Settings",'setting'=>$settings]);
    }


    public function save_settings(Request $request)
    {
        $adminId = session('adminData')->id;
        $data=Admin::where('id', $adminId)->first();

        $data->comment_auto=$request->comment_auto;
        $data->user_auto=$request->user_auto;
        $data->recent_limit=$request->recent_limit;
        $data->popular_limit=$request->popular_limit;
        $data->recent_comment_limit=$request->recent_comment_limit;
        $data->save();

        return redirect('admin/setting')->with('success', 'Data has been updated.');
    }
}
