
@extends('layout.backend.app')
@section('meta_desc',$meta_desc ?? '')
@section('title',$title)
@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>


  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Posts
      <a href="{{url('admin/post/create')}}" class="float-right btn btn-sm btn-dark">Add Post</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Category</th>
              <th>Title</th>
              <th>Image</th>
              <th>Full</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Category</th>
              <th>Title</th>
              <th>Image</th>
              <th>Full</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
              @foreach($data as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->category->title}}</td>
                <td>{{$post->title}}</td>
                <td><img src="{{ asset('imgs/thumb').'/'.$post->thumb }}" width="100" /></td>
                <td><img src="{{ asset('imgs/full').'/'.$post->full_img }}" width="100" /></td>
                <td>
                  @if ($post->status == 0)
                    <a class="btn btn-info btn-sm" href="{{url('admin/post/'.$post->id.'/active')}}">Activate</a>
                  @else
                  <a class="btn btn-info btn-sm" href="{{url('admin/post/'.$post->id.'/inactive')}}">Deactivate</a>
                  @endif
                  <a class="btn btn-info btn-sm" href="{{url('admin/post/'.$post->id.'/edit')}}">Update</a>
                  <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm" href="{{url('admin/post/'.$post->id.'/delete')}}">Delete</a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection
