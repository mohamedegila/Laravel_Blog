@extends('layout.frontend.app')
@section('title','Save Post')

@section('content')
		<div class="row">
			<div class="col-md-8 mb-5">
				<h3>Add Post</h3>
				<div class="table-responsive">

                @if($errors)
                  @foreach($errors->all() as $error)
                    <p class="text-danger">{{$error}}</p>
                  @endforeach
                @endif

                @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
                @endif

                <form method="post" action="{{url('save-post-form')}}" enctype="multipart/form-data">
                  @csrf
                  <table class="table table-bordered">
                      <tr>
                          <th>Category<span class="text-danger">*</span></th>
                          <td>
                            <select class="form-control" name="category">
                              @foreach($cats as $cat)
                              <option value="{{$cat->id}}">{{$cat->title}}</option>
                              @endforeach
                            </select>
                          </td>
                      </tr>
                      <tr>
                          <th>Title<span class="text-danger">*</span></th>
                          <td><input type="text" name="title" class="form-control" /></td>
                      </tr>
                      <tr>
                          <th>Thumbnail</th>
                          <td><input type="file" name="post_thumb" /></td>
                      </tr>
                      <tr>
                          <th>Full Image</th>
                          <td><input type="file" name="post_image" /></td>
                      </tr>
                      <tr>
                          <th>Detail<span class="text-danger">*</span></th>
                          <td>
                            <textarea class="form-control" name="details"></textarea>
                          </td>
                      </tr>
                      <tr>
                          <th>Tags</th>
                          <td>
                            <textarea class="form-control" name="tags"></textarea>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <input type="submit" class="btn btn-primary" />
                          </td>
                      </tr>
                  </table>
                </form>
              </div>
			</div>
		
@endsection('content')