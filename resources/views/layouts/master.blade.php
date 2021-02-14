<!DOCTYPE html>
<html lang="en">
<head>
 @include('layouts.partials._head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
{{-- Navbar --}}
 @include('layouts.partials._navbar')
 
 {{-- Sidebar --}}
 @include('layouts.partials._sidebar')
  
  <div class="content-wrapper">
   	{{-- Flash Message --}}
  	@include('flash::message')

    @yield('content')
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  @include('layouts.partials._footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
 @include('layouts.partials._script')
</body>
</html>

