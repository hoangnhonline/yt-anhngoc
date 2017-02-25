<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo e(Auth::user()->email != "huongll@icho.vn" ? route('product.index') : route('product.short')); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>iCho.vn</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>iCho.vn</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <?php if(Auth::user()->email != "huongll@icho.vn"): ?>
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <?php endif; ?>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">     
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
            <i class="fa fa-gears"></i><span class="hidden-xs">Chào <?php echo e(Auth::user()->full_name); ?></span>
          </a>
          <ul class="dropdown-menu">            
            <li class="user-footer">
            <div class="pull-left">
                <a href="<?php echo e(route('account.change-pass')); ?>" class="btn btn-success btn-flat">Đổi mật khẩu</a>
              </div>             
              <div class="pull-right">

                <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger btn-flat">Thoát</a>
              </div>
            </li>
          </ul>
        </li>          
      </ul>
    </div>
  </nav>
</header>