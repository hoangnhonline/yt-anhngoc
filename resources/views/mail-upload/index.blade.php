@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Mail upload
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'mail-upload.index' ) }}">Mail upload</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif      
      <a href="{{ route('mail-upload.create') }}" class="btn btn-info" style="margin-bottom:5px">Tạo mới</a>
      
      
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách </h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
            
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                                         
              <th>Email</th>
              <th>Password</th>
              <th>Trạng thái</th>              
              <th width="1%;white-space:nowrap">Thao tác</th>              
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>               
                <td>{{ $item->email }}</td>      
                <td>{{ $item->password }}</td>               
                <td>
                  <select class="form-control status " data-value="{{ $item->id }}">
                    <option value="1" {{ $item->status == 1 ? "selected" : "" }}>Mở</option>                  
                    <option value="2" {{ $item->status == 2 ? "selected" : "" }}>Khóa</option>
                  </select>
                </td>
                <td style="white-space:nowrap">                                
                <a class="btn btn-primary btn-sm" href="{{ route('link-video.index', ['id_mail' => $item->id]) }}" ><span class="badge">
                    {{ $item->videos->count() }}
                  </span> Link video </a>
                  <a href="{{ route( 'mail-upload.edit', [ 'id' => $item->id ]) }}" class="btn-sm btn btn-warning">Chỉnh sửa</a>                                   
                  <a onclick="return callDelete('{{ $item->title }}','{{ route( 'mail-upload.destroy', [ 'id' => $item->id ]) }}');" class="btn-sm btn btn-danger">Xóa</a>
                </td>              
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            @endif

          </tbody>
          </table>
           
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<style type="text/css">
  .select2-container--default .select2-selection--single{
    height: 34px !important;

  }
  .select2-container .select2-selection--single .select2-selection__rendered{
    padding-left: 0px !important;
  }
</style>
@stop
@section('javascript_page')
<script type="text/javascript">
function callDelete(name, url){  
  swal({
    title: 'Bạn chắc chắn xóa ?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(function(){
  $('select.status').change(function(){
    var id = $(this).attr('data-value');
    var status = $(this).val();
      $.ajax({
        url : '{{ route('update-status-email') }}',
        type : 'POST',
        data : {
          status : status,
          id : id
        },
        success : function(data){          
        }
      }); 
  });
});
</script>
@stop