<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{route('admin.index')}}" class="nav-link" id="dashboard">
            <i class="nav-icon fas fa-th"></i>
            <p>
                {{__('Dashboard')}}
            </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('admin.profile.edit')}}" class="nav-link" id="profile">
            <i class="nav-icon fas fa-user-circle"></i>
            <p>
                {{__('Profile')}}
            </p>
        </a>
      </li>

      @can('view_branch')
        <li class="nav-item">
          <a href="{{route('admin.branches.index')}}" class="nav-link" id="branches">
            <i class="fas fa-map-marked-alt nav-icon"></i>
            <p>{{__('Branches')}}</p>
          </a>
        </li>
      @endcan

      @can('view_test')
      <li class="nav-item">
        <a href="{{route('admin.tests.index')}}" class="nav-link" id="tests">
          <i class="nav-icon fas fa-flask"></i>
          <p>
            {{__('Tests')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_culture')
      <li class="nav-item">
        <a href="{{route('admin.cultures.index')}}" class="nav-link" id="cultures">
          <i class="nav-icon fas fa-vial"></i>
          <p>
            {{__('Cultures')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_culture_option')
      <li class="nav-item">
        <a href="{{route('admin.culture_options.index')}}" class="nav-link" id="culture_options">
          <i class="nav-icon fas fa-vial"></i>
          <p>
            {{__('Culture options')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_antibiotic')
      <li class="nav-item">
        <a href="{{route('admin.antibiotics.index')}}" class="nav-link" id="antibiotics">
          <i class="nav-icon fas fa-capsules"></i>
          <p>
            {{__('Antibiotics')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_doctor')
      <li class="nav-item">
        <a href="{{route('admin.doctors.index')}}" class="nav-link" id="doctors">
          <i class="nav-icon fa fa-user-md"></i>
          <p>
            {{__('Doctors')}}
          </p>
        </a>
      </li>
      @endcan

      @canany(['view_test_prices','view_culture_prices'])
        <li class="nav-item has-treeview" id="prices">
          <a href="#" class="nav-link" id="prices_link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              {{__('Price List')}}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            @can('view_test_prices')
            <li class="nav-item">
              <a href="{{route('admin.prices.tests')}}" class="nav-link" id="tests_prices">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Tests')}}</p>
              </a>
            </li>
            @endcan
            
            @can('view_culture_prices')
            <li class="nav-item">
              <a href="{{route('admin.prices.cultures')}}" class="nav-link" id="cultures_prices">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Cultures')}}</p>
              </a>
            </li>
            @endcan
          
          </ul>
        </li>
      @endcan

      @can('view_contract')
      <li class="nav-item">
        <a href="{{route('admin.contracts.index')}}" class="nav-link" id="contracts">
          <i class="fas fa-file-contract nav-icon"></i>
          <p>{{__('Contracts')}}</p>
        </a>
      </li>
      @endcan

      @can('view_patient')
      <li class="nav-item">
        <a href="{{route('admin.patients.index')}}" class="nav-link" id="patients">
          <i class="nav-icon fas fa-user-injured"></i>
          <p>
            {{__('Patients')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_visit')
      <li class="nav-item">
        <a href="{{route('admin.visits.index')}}" class="nav-link" id="visits">
          <i class="nav-icon fas fa-home"></i>
          <p>
            {{__('Home Visits')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_group')
      <li class="nav-item">
        <a href="{{route('admin.groups.index')}}" class="nav-link" id="groups">
          <i class="nav-icon fas fa-layer-group"></i>
          <p>
            {{__('Group Tests')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_report')
      <li class="nav-item">
        <a href="{{route('admin.reports.index')}}" class="nav-link" id="reports">
          <i class="nav-icon fas fa-flag"></i>
          <p>
            {{__('Reports')}}
          </p>
        </a>
      </li>
      @endcan

      @can('view_chat')
          <li class="nav-item">
            <a href="{{route('admin.chat.index')}}" class="nav-link" id="chat">
              <i class="nav-icon far fa-comment-dots"></i>
              <p>
                {{__('Chat')}}
              </p>
            </a>
          </li>
      @endcan

      @canany(['view_accounting_reports','view_expense','view_expense_category'])
      <li class="nav-item has-treeview" id="accounting">
        <a href="#" class="nav-link" id="accounting_link">
          <i class="nav-icon fas fa-calculator"></i>
          <p>
            {{__('Accounting')}}
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          @can('view_expense_category')
          <li class="nav-item">
            <a href="{{route('admin.expense_categories.index')}}" class="nav-link" id="expense_categories">
              <i class="far fa-circle nav-icon"></i>
              <p>
                {{__('Expense Categories')}}
              </p>
            </a>
          </li>
          @endcan

          @can('view_expense')
          <li class="nav-item">
            <a href="{{route('admin.expenses.index')}}" class="nav-link" id="expenses">
              <i class="far fa-circle nav-icon"></i>
              <p>
                {{__('Expenses')}}
              </p>
            </a>
          </li>
          @endcan

          @can('view_accounting_reports')
          <li class="nav-item">
            <a href="{{route('admin.accounting.index')}}" class="nav-link" id="accounting_reports">
              <i class="far fa-circle nav-icon"></i>
              <p>
                {{__('Accounting Report')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.accounting.doctor_report')}}" class="nav-link" id="accounting_doctor_reports">
              <i class="far fa-circle nav-icon"></i>
              <p>
                {{__('Doctor accounting report')}}
              </p>
            </a>
          </li>
          @endcan

        </ul>
      </li>
      @endcan

     

      @canany(['view_user','view_role'])
        <li class="nav-item has-treeview" id="users_roles">
          <a href="#" class="nav-link" id="users_roles_link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              {{__('Roles And Users')}}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            @can('view_role')
            <li class="nav-item">
              <a href="{{route('admin.roles.index')}}" class="nav-link" id="roles">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Roles')}}</p>
              </a>
            </li>
            @endcan

            @can('view_user')
            <li class="nav-item">
              <a href="{{route('admin.users.index')}}" class="nav-link" id="users">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Users')}}</p>
              </a>
            </li>
            @endcan

          </ul>
        </li>
      @endcan
      
      @can('view_setting')
      <li class="nav-item">
        <a href="{{route('admin.settings.index')}}" class="nav-link" id="settings">
          <i class="fa fa-cogs nav-icon"></i>
          <p>{{__('Settings')}}</p>
        </a>
      </li>
      @endcan

      @can('view_translation')
      <li class="nav-item">
        <a href="{{route('admin.translations.index')}}" class="nav-link" id="translations">
          <i class="fa fa-book nav-icon"></i>
          <p>{{__('Translations')}}</p>
        </a>
      </li>
      @endcan

      @can('view_activity_log')
      <li class="nav-item">
        <a href="{{route('admin.activity_logs.index')}}" class="nav-link" id="activity_logs">
          <i class="fa fa-server nav-icon"></i>
          <p>{{__('Activity Logs')}}</p>
        </a>
      </li>
      @endcan

      @can('view_backup')
      <li class="nav-item">
        <a href="{{route('admin.backups.index')}}" class="nav-link" id="backups">
          <i class="fa fa-database nav-icon"></i>
          <p>{{__('Database Backups')}}</p>
        </a>
      </li>
      @endcan


    </ul>
  </nav>