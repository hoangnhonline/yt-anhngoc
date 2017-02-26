<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ URL::asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->full_name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>     
      <li {{ in_array(\Request::route()->getName(), ['link-video.create', 'link-video.index']) ? "class=active" : "" }}>
        <a href="{{ route('link-video.index') }}">
          <i class="fa fa-reorder"></i> 
          <span>Link video</span>         
        </a>       
      </li>
      @if(Auth::user()->role == 3)
      <li {{ in_array(\Request::route()->getName(), ['chu-de.index', 'chu-de.create', 'chu-de.edit']) ? "class=active" : "" }}>
        <a href="{{ route('chu-de.index') }}">
          <i class="fa fa-reorder"></i> 
          <span>Chủ đề</span>         
        </a>       
      </li>
      <li {{ in_array(\Request::route()->getName(), ['thuoc-tinh-chu-de.index', 'thuoc-tinh-chu-de.create', 'thuoc-tinh-chu-de.edit']) ? "class=active" : "" }}>
        <a href="{{ route('thuoc-tinh-chu-de.index') }}">
          <i class="fa fa-reorder"></i> 
          <span>Thuộc tính</span>         
        </a>       
      </li>
      <li {{ in_array(\Request::route()->getName(), ['mail-upload.index', 'mail-upload.create', 'mail-upload.edit']) ? "class=active" : "" }}>
        <a href="{{ route('mail-upload.index') }}">
          <i class="fa fa-reorder"></i> 
          <span>Mail upload</span>         
        </a>       
      </li>
      <li {{ in_array(\Request::route()->getName(), ['account.index', 'account.create', 'account.edit']) ? "class=active" : "" }}>
        <a href="{{ route('account.index') }}">
          <i class="fa fa-reorder"></i> 
          <span>Account</span>         
        </a>       
      </li>
      @endif

   
      <!--<li class="header">LABELS</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<style type="text/css">
  .skin-blue .sidebar-menu>li>.treeview-menu{
    padding-left: 15px !important;
  }
</style>