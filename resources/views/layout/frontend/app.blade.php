@include('layout.frontend.header')
@include('layout.frontend.navbar')
{{-- @include('layout.frontend.menu') --}}

@yield('content')
@include('layout.frontend.rightsidebar')
@include('layout.frontend.footer')