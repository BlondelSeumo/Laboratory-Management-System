<!DOCTYPE html>
<html>
<head>
  @include('partials.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
  <div class="preloader">
  </div>
  <div class="loader"></div>

  <div class="wrapper">

    <!-- Navbar -->
    @include('partials.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @yield('breadcrumb')
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @include('partials.validation_errors')
          @yield('content')
          <input type="hidden" id="system_currency" value="{{cache('currency')}}">
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    
    <!-- Footer -->
    @include('partials.footer')
    <!-- /.Footer -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

  </div>
  <!-- ./wrapper -->

  @include('partials.scripts')

  @yield('scripts')

</body>
</html>
