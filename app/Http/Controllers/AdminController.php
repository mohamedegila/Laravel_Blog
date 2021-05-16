<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repository\PostRepository;
use App\Services\post\DashboardInfo;
use Auth;
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
            'email' => 'required',
            'password' => 'required'

        ]);
    
        $remember = request()->has('remember')?true:false;
        if (Auth::guard('webadmin')->attempt(['email' => request('email'), 'password' => request('password')], $remember)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Invalid username/password');
        }
    }

    //Dashboard
    public function dashboard(DashboardInfo $posts_service)
    {
        $posts_info = $posts_service->execute();
        $activeComments_count   = Comment::where('status', 1)->count();
        $inactiveComments_count = Comment::where('status', 0)->count();
        //dd($posts_info);
        $comments_count = Comment::count();
        $users_count = User::count();
        $categories_count = Category::count();
        $comments_info = [
                 'comments_count'       =>$comments_count,
                 'activeComments_count'    =>$activeComments_count,
                 'inactiveComments_count'  =>$inactiveComments_count
                ];
        $users_info = [
            
            'users_count'          =>$users_count,
        ];

        $categories_info=[
            'categories_count'     =>$categories_count,
        ];
        return view(
            'Admin.dashboard',
            [
            'posts_info'       =>$posts_info,
            'comments_info'    =>$comments_info,
            'categories_info'  =>$categories_info,
            'users_info'       =>$users_info,
            'title'=>'Dashboard'
        ]
        );
    }

    // Show all users
    public function users()
    {
        $data=User::orderBy('id', 'desc')->get();
        return view('Admin.user.index', ['data'=>$data]);
    }

    public function delete_user($id)
    {
        User::where('id', $id)->delete();
        return redirect('admin/user');
    }

    // Logout
    public function logout()
    {
        Auth::guard('webadmin')->logout();
        return redirect()->route('admin.login');
    }
}
