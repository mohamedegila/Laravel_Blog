@extends('layout.frontend.app')
@section('title',$detail->title)
@section('content')
		<div class="row">
			<div class="col-md-8">
				@if(Session::has('success'))
					<p class="text-success">{{session('success')}}</p>
				@endif
				<div class="card">
					<h5 class="card-header">
						{{$detail->title}}
						<span class="float-right">Total Views <span class="badge badge-dark">{{$detail->views}}</span></span>
					</h5>
					<img src="{{asset('imgs/full/'.$detail->full_img)}}" class="card-img-top" alt="{{$detail->title}}">
					<div class="card-body">
						{{$detail->detail}}
					</div>
					<div class="card-footer">
						In <a href="{{url('category/'.Str::slug($detail->category->title).'/'.$detail->category->id)}}">{{$detail->category->title}}</a>
					</div>
				</div>
				@auth
				<!-- Add Comment -->
				<div class="card my-5">
					<h5 class="card-header">Add Comment</h5>
					<div class="card-body">
						<form method="post" action="{{url('save-comment/'.Str::slug($detail->title).'/'.$detail->id)}}">
						@csrf
						<textarea name="comment" class="form-control"></textarea>
						<input type="submit" class="btn btn-dark mt-2" />
					</div>
				</div>
				@endauth
				<!-- Fetch Comments -->
				<div class="card my-4">
					<h5 class="card-header">Comments <span class="badge badge-dark">{{count($detail->comments)}}</span></h5>
					<div class="card-body">
						@if($detail->comments)
							@foreach($detail->comments as $comment)
								<blockquote class="blockquote">
								  <p class="mb-0">{{$comment->comment}}</p>
								  @if($comment->user_id==1)
								  <footer class="blockquote-footer">Admin</footer>
								  @else
								  <footer class="blockquote-footer">{{$comment->user->name}}</footer>
								  @endif
								</blockquote>
								<hr/>
							@endforeach
						@endif
					</div>
				</div>
			</div>
			
@endsection('content')