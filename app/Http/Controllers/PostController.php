<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Services\post\AllPosts;
use App\Services\post\ChangeStatus;
use App\Services\post\Create;
use App\Services\post\Destroy;
use App\Services\post\PostById;
use App\Services\post\Update;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AllPosts $service)
    {
        $data = $service->execute();
        return view(
            'Admin.post.index',
            [
                'data'=>$data,
                'title'=>'All Posts',
                'meta_desc'=>'This is meta description for all categories'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.post.add', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Create $saveAdminPostService)
    {
        $saveAdminPostService->execute($request);

        return redirect('admin/post/create')->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostById $getByIdService)
    {
        $data = $getByIdService->execute($id);
        $categories = Category::all();
        return view('Admin.post.update', ['data'=>$data,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Update $updateService)
    {
        $updateService->execute($request, $id);
        return redirect('admin/post/'.$id.'/edit')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Destroy $destroyService)
    {
        $destroyService->execute($id);
        return redirect('admin/post');
    }

    public function active($id, ChangeStatus $statusService)
    {
        $statusService->execute($id, 1);
        return redirect('admin/post');
    }

    public function inactive($id, ChangeStatus $statusService)
    {
        $statusService->execute($id, 0);

        return redirect('admin/post');
    }
}
