<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //login View
    public function login()
    {
        return view('Admin.login');
    }

    // Submit Login
    public function submitLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'

        ]);
        
        //$admins = Admin::all();
        // dd(Admin::where(['username' => $request->username , 'password' => $request->password]));
        $userCheck = Admin::where(['username'=>$request->username,'password'=>$request->password])->count();
        //  dd($userCheck);
        if ($userCheck > 0) {
            $adminData=Admin::where(['username'=>$request->username,'password'=>$request->password])->first();
            session(['adminData'=>$adminData]);
            return redirect('admin/dashboard');
        } else {
            return redirect('admin/login')->with('error', 'Invalid username/password');
        }
    }

    //Dashboard
    public function dashboard()
    {
        $posts=Post::orderBy('id', 'desc')->get();
        return view(
            'Admin.dashboard',
            [
            'posts'=>$posts,
            'title'=>'Dashboard'
        ]
        );
    }

    // Logout
    public function logout()
    {
        session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
