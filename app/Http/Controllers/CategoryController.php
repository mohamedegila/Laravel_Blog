<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Mockery\Undefined;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('Admin.category.index', [
            'data'=>$data,
            'title'=>'All Categories',
            'meta_desc'=>'This is meta description for all categories'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'detail'=>'required',
            'cat_image'=>'required'
        ]);

        $reImage='na';
        if ($request->hasFile('cat_image')) {
            $image=$request->file('cat_image');
            $reImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest, $reImage);
        }
        $category = new Category;
        $category->title = $request->title;
        $category->detail=$request->detail;
        $category->image= $reImage;
        $category->save();

        return redirect('admin/category/create')->with('success', 'Data has been added');
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
    public function edit($id)
    {
        $data = Category::find($id);
        return view('Admin.category.update', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'detail'=>'required',
            'cat_image'=>'required'
        ]);
        
        if ($request->hasFile('cat_image')) {
            $image=$request->file('cat_image');
            $reImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest, $reImage);
        } else {
            $reImage=$request->cat_image;
        }
        $category = Category::find($id);
        $category->title = $request->title;
        $category->detail=$request->detail;
        $category->image= $reImage;
        $category->save();

        return redirect('admin/category/'.$id.'/edit')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();

        if ($category->image !== '' || $category->image !== 'na') {
            $path = public_path('/imgs').'/'.$category->image;
            unlink($path);
        }
        $category->delete();
        return redirect('admin/category');
    }
}
