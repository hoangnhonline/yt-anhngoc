<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('link-video.index') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>YT</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>YT</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->    
    @if(Auth::user()->role == 3)
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>    
    @endif
    
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">     
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
            <i class="fa fa-gears"></i><span class="hidden-xs">Chào {{ Auth::user()->full_name }}</span>
          </a>
          <ul class="dropdown-menu">            
            <li class="user-footer">
            <div class="pull-left">
                <a href="{{ route('account.change-pass') }}" class="btn btn-success btn-flat">Đổi mật khẩu</a>
              </div>             
              <div class="pull-right">

                <a href="{{ route('logout') }}" class="btn btn-danger btn-flat">Thoát</a>
              </div>
            </li>
          </ul>
        </li>          
      </ul>
    </div>
  </nav>
  @if(Auth::user()->role == 1 && Auth::user()->viewed == 0)
  <div class="col-md-12" id="remarks_div">
    <div class="alert alert-danger fade in alert-dismissable" style="padding-top: 5px;padding-bottom: 5px;margin-top: 5px;">{{ Auth::user()->remarks }} &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" id="btnDaXem">Đã xem</button></div>
  </div>
  @endif
</header>
