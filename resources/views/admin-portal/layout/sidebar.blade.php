<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="" class="site_title"> <span>Portal Admin</span></a>
    </div>

    <div class="clearfix"></div>

    <div class="profile">
      <div class="profile_pic">
        <img src="{{ asset('public/backend/images/user.png') }}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Hai,</span>
        <h2>{{ Auth::user()->name }}</h2>
      </div>
    </div>

    <div class="clearfix"></div>

    <br />

    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li class="{{ Route::is('adpor.dashboard') ? 'active' : '' }}">
            <a href="{{ route('adpor.dashboard') }}"><i class="fa fa-home"></i> Dashbord </a>
          </li>
          <li class="{{ Route::is('adpor.user.index') ? 'current-page' : '' }}">
            <a href="{{ route('adpor.user.index') }}">
              <i class="fa fa-users"></i> Account</span>
            </a>
          </li>
          <li class="{{ Route::is('adpor.ccw*') ? 'active' : '' }}"><?php // Content Web ?>
            <a>
              <i class="fa fa-globe"></i> Content Web <span class="fa fa-chevron-down"></span>
            </a>
              <ul class="nav child_menu">
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => 'banner']) }}">Banner</a>
                </li>
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => 'product']) }}">Product</a>
                </li>
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => 'product_detail']) }}">Product Detail</a>
                </li>
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => 'project']) }}">Project</a>
                </li>
              </ul>
            </a>
          </li>
          <li class="{{ Route::is('adpor.message') ? 'current-page' : '' }}">
            <a href="{{ route('adpor.message') }}">
              <i class="fa fa-book"></i> Message</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>
