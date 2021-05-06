<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
<a class="navbar-brand" href="{{url('/')}}">Blog</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="{{url('/')}}">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('all-categories')}}">Categories</a>
    </li>
    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{url('login')}}">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('register')}}">Register</a>
    </li>
    @else
    <li class="nav-item">
      <a class="nav-link" href="{{url('save-post-form')}}">Add Post</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('manage-posts')}}">Manage Posts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{url('logout')}}">Logout</a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
    @endguest
  </ul>
</div>
</div>
</nav>
        	<!-- Get latest posts -->
          <main class="container mt-4">