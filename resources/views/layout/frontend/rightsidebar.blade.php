<!-- Right SIdebar -->
<div class="col-md-4">
    <!-- Search -->
    <div class="card mb-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form action="{{url('/')}}">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" />
                  <div class="input-group-append">
                    <button class="btn btn-dark" type="submit" id="button-addon2">Search</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Recent Posts -->
    <div class="card mb-4">
        <h5 class="card-header">Recent Posts</h5>
        <div class="list-group list-group-flush">
            @if($recent_posts)
                @foreach($recent_posts as $post)
                    <a href="#" class="list-group-item">{{$post->title}}</a>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Popular Posts -->
    <div class="card mb-4">
        <h5 class="card-header">Popular Posts</h5>
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item">Post 1</a>
            <a href="#" class="list-group-item">Post 2</a>
        </div>
    </div>
</div>
</div>