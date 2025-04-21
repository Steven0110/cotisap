<div class="an-sidebar-nav">
  <ul class="an-main-nav">
    <!-- Dashboard Menu Item -->
    <li class="an-nav-item">
      <a href="{{ URL::route('dashboard') }}">
        <span class="nav-title">
          Dashboard
        </span>
      </a>
    </li>

    <!-- Users Menu with Children -->
    <li class="an-nav-item">
      <a class="js-show-child-nav" href="#">
        <span class="nav-title">
          Users Management
          <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
        </span>
      </a>
      <ul class="an-child-nav js-open-nav">
        <li><a href="#">All Users</a></li>
        <li><a href="#">Create User</a></li>
        <li><a href="#">Permissions</a></li>
      </ul>
    </li>

    <!-- Reports Menu with Children -->
    <li class="an-nav-item">
      <a class="js-show-child-nav" href="#">
        <span class="nav-title">
          Reports
          <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
        </span>
      </a>
      <ul class="an-child-nav js-open-nav">
        <li><a href="#">Sales Reports</a></li>
        <li><a href="#">Analytics</a></li>
        <li><a href="#">Export Data</a></li>
      </ul>
    </li>

    <!-- Settings Menu Item -->
    <li class="an-nav-item">
      <a href="#">
        <span class="nav-title">
          Settings
        </span>
      </a>
    </li>

  </ul>
</div>