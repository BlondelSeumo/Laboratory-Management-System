<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{url('img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{$info['name']}}</span>
    </a>
    <!-- \Brand Logo -->
    
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              @if(Auth::guard('admin')->check())
                {{Auth::guard('admin')->user()->name}}
              @else 
                {{Auth::guard('patient')->user()->name}}<br>
                {{__('Code')}}: {{Auth::guard('patient')->user()->code}}
              @endif
            </a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <!-- Admin sidebar -->
        @can('admin')
        @include('partials.admin_sidebar')
        <!-- \Admin sidebar -->
        <!-- Patient sidebar -->
        @elsecan('patient')
          @include('partials.patient_sidebar')
        @endcan
        <!-- \Patient sidebar -->
      <!-- /.sidebar-menu -->
    </div>
</aside>
<!-- /.sidebar -->