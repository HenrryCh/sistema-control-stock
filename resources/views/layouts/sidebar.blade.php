  {{--  
  <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color:hsl(0, 0%, 25%);">
  <a href="{{ route('home') }}" class="brand-link" style="display: flex; align-items: center;">
    <img src="{{ asset('img/logo.png') }}" width="40px" alt="AdminLTE Logo" class="brand-image-xl.single img-circle elevation-3">
    <span class="brand-text font-weight-bold" style="color:orange;">{{ config('app.name') }}</span>
  </a>
  --}}
  <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color:#212529;">
    <a href=" " class="brand-link" style="display: flex; align-items: center;">
      <img src="{{ asset('img/logo.png') }}" width="40px" alt="AdminLTE Logo" class="brand-image-xl.single img-circle elevation-3">
      <img src="{{ asset('img/uvs.png') }}" width="120px" alt="UVS Logo" style="margin-left: 30px; border-radius: 0;">
    </a> 

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @include('layouts.menu')
      </ul>
    </nav>
  </div>
</aside>
