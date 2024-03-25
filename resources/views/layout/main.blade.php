<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KOPERASI SKENDA | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('LTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('LTE/dist/css/adminlte.min.css') }}">
  {{-- Css Eksternal --}}
  <link rel="stylesheet" href="{{ asset('css/stylea.css') }}">


</head>
<body class="hold-transition sidebar-mini sidebar-collapse">

<div class="wrapper">

  {{-- NAVBAR --}}
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto mr-2">
      <li>
        <li>
          <p>{{ Auth::user()->level }}</p>
        </li>
      </li>
    </ul>

  </nav>

  {{-- SIDEBAR --}}
  <aside class="position-fixed main-sidebar keppel-mode sidebar-light-primary elevation-4">
    
    <a href="#" class="brand-link">
      <img src="{{ asset('image/smkn2.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="poppins brand-text paraf">KOPERASI SMKN 2</span>
    </a>

    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt" style="color: #ffffff;"></i>
              <p class="poppins paraf">
                Dashboard
              </p>
            </a>
          </li>
        </ul>
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.user') }}" class="nav-link">
              <i class="nav-icon fa-solid fa-user" style="color: #ffffff;"></i>
              <p class="poppins paraf">
                Data User
              </p>
            </a>
          </li>
        </ul>
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.produk') }}" class="nav-link">
              <i class="nav-icon fa-solid fa-table" style="color: #ffffff;"></i>
              <p class="poppins paraf">
                Data Produk
              </p>
            </a>
          </li>
        </ul>
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.penjualan') }}" class="nav-link">
              <i class="nav-icon fa-solid fa-table" style="color: #ffffff;"></i>
              <p class="poppins paraf">
                Data Penjualan
              </p>
            </a>
          </li>
        </ul>
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt" style="color: #ffffff;"></i>
              <p class="poppins paraf">
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>

    </div>

  </aside>


  @yield('content')

</div>

<!-- jQuery -->
<script src="{{ asset('LTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('LTE/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('LTE/dist/js/demo.js') }}"></script>