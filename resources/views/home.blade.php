@extends('layout.frontend.app')
@section('title','Home Page')
@section('content')
		<div class="row">
			<div class="col-md-8">
				<div class="row mb-5"> 
					@if(count($posts)>0)
						@foreach($posts as $post)
						<div class="col-md-4 mb-5">
							<div class="card h-100">
							  <a class="h-75"href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}"><img class="w-100 h-100" src="{{asset('imgs/thumb/'.$post->thumb)}}" class="card-img-top" alt="{{$post->title}}" /></a>
							  <div class="card-body h-25">
							    <h5 class="card-title"><a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}">{{$post->title}}</a></h5>
							  </div>
							</div>
						</div>
						@endforeach
					@else
					<p class="alert alert-danger">No Post Found</p>
					@endif
				</div>
				<!-- Pagination -->
				<div class="d-flex justify-content-center">

					{{$posts->links()}}
				</div>
			</div>
			
@endsection('content')