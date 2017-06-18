  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name .' '. auth()->user()->last_name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <li><a href="{{ config('app.url') }}/home"><i class="fa fa-home fa-fw"></i><span>Home</span></a></li>
        <li><a href="{{ config('app.url') }}/user/{{ Auth::user()->id }}"><i class="fa fa-user-circle fa-fw"></i><span>Profile</span></a></li>
        <li><a href="{{ config('app.url') }}/messages"><i class="fa fa-envelope fa-fw"></i><span>Messages</span></a></li>        
        <li class="treeview">
          <a href="#"><i class="fa fa-sitemap fa-fw"></i><span>Adminstration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li>
              <a href="#"><span>Permissions et Rols</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ config('app.url') }}/permissions"><span>Permissions</span></a></li>
                <li><a href="{{ config('app.url') }}/roles"><span>Rôles</span></a></li>
              </ul>
            </li>
            <li><a href="{{ config('app.url') }}/users"><span>Utilisateurs</span></a></li>
            <li><a href="{{ config('app.url') }}/facultes"><span>Facultes</span></a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
