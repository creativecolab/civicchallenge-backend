@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
          <li><a href="{{ url('admin/category') }}"><i class="fa fa-tags"></i> <span>Manage Categories</span></a></li>
          <li><a href="{{ url('admin/challenge') }}"><i class="fa fa-tasks"></i> <span>Manage Challenges</span></a></li>
          <li><a href="{{ url('admin/resource') }}"><i class="fa fa-book"></i> <span>Manage Resources</span></a></li>
          <li><a href="{{ url('admin/insight') }}"><i class="fa fa-comment"></i> <span>Manage Insights</span></a></li>
          <li><a href="{{ url('admin/question') }}"><i class="fa fa-question-circle"></i> <span>Manage Questions</span></a></li>
          <li><a href="{{ url('admin/user') }}"><i class="fa fa-user"></i> <span>Manage Users</span></a></li>

          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
