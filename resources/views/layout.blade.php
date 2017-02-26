<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>YT | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ URL::asset('http://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css') }}">
  
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ URL::asset('backend/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('backend/dist/css/AdminLTE.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ URL::asset('backend/dist/css/skins/_all-skins.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('backend/plugins/iCheck/flat/blue.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('backend/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('backend/dist/css/sweetalert2.min.css') }}">  

<style type="text/css">
  @if(Auth::user()->role==1)
.content-wrapper{
  margin-left: 0px !important;
}
@endif

</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('layout.header')
  @if(Auth::user()->email != "huongll@icho.vn" && \Request::route()->getName() != "compare.index" )
    @include('layout.sidebar')
  @endif

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
 
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.5
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="mailto:hoangnhonline@gmail.com">hoangnhonline@gmail.com</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

  <div class="control-sidebar-bg"></div>
</div>
<input type="hidden" id="upload_url" value="{{ config('icho.upload_url') }}">
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ URL::asset('backend/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('https://code.jquery.com/ui/1.10.0/jquery-ui.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::asset('backend/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('backend/dist/js/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('backend/dist/js/select2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('backend/dist/js/app.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('backend/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('backend/dist/js/demo.js') }}"></script>

<script src="{{ URL::asset('backend/dist/js/jquery.number.min.js') }}"></script>
<script src="{{ URL::asset('backend/dist/js/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript" type="text/javascript">

$(document).ready(function(){  
  $('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
  $('.number').number(true, 0);
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

 });
</script>
<style type="text/css">
  .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
    z-index: 1 !important;
  }
  @if(\Request::route()->getName() == "compare.index")
.content-wrapper, .main-footer{
  margin-left: 0px !important;
}
@endif
</style>

@yield('javascript_page')
</body>
</html>