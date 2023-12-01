<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="{{url('dashboard')}}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('client') ? 'active' : ''}}" href="{{url('client')}}">
              <span data-feather="user" class="align-text-bottom"></span>
              Client
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{Request::is('project') ? 'active' : ''}}" href="{{url('project')}}">
              <span data-feather="file" class="align-text-bottom"></span>
              Project
            </a>
          </li>
         
          
        </ul>
      </div>
    </nav>