<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{route('patient.index')}}" class="nav-link" id="dashboard">
            <i class="nav-icon fas fa-th"></i>
            <p>
                {{__('Dashboard')}}
            </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('patient.profile.edit')}}" class="nav-link" id="profile">
          <i class="nav-icon fas fa-user-circle"></i>
          <p>
            {{__('Profile')}}
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('patient.groups.index')}}" class="nav-link" id="groups">
          <i class="nav-icon fas fa-flask"></i>
          <p>
            {{__('Reports')}}
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('patient.tests_library.index')}}" class="nav-link" id="tests_library">
          <i class="fas fa-book-medical nav-icon"></i>
          <p>
            {{__('Tests Library')}}
          </p>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="{{route('patient.visits.index')}}" class="nav-link" id="visits">
          <i class="nav-icon fas fa-home"></i>
          <p>
            {{__('Home Visit')}}
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('patient.branches.index')}}" class="nav-link" id="branches">
          <i class="fas fa-map-marked-alt nav-icon"></i>
          <p>
            {{__('Our Branches')}}
          </p>
        </a>
      </li>
    </ul>
  </nav>