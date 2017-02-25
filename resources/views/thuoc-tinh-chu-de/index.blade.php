@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Thuộc tính chủ đề
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'thuoc-tinh-chu-de.index' ) }}">Thuộc tính chủ đề</a></li>
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
      <a href="{{ route('thuoc-tinh-chu-de.create') }}" class="btn btn-info" style="margin-bottom:5px">Tạo mới</a>
      
       <div class="panel panel-default">        
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('thuoc-tinh-chu-de.index') }}">                        
                        
            <div class="form-group">              
              <label for="id_chude">Chủ đề</label>
              <select name="id_chude" class="form-control select2" id="id_chude">                   
                @foreach($chudeList as $chude)                
                <option value="{{ $chude->id }}" {{ $id_chude == $chude->id ? "selected" : "" }}>{{ $chude->ten }}</option>
                @endforeach                    
              </select>
            </div>           
            <button type="submit" class="btn btn-primary">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( {{ $items->total() }} )</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
            
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                                         
              <th>Tên</th>              
              <th width="1%;white-space:nowrap">Thao tác</th>              
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>               
                <td>{{ $item->ten }}</td>               
              
                <td style="white-space:nowrap">               
                  <a href="{{ route( 'thuoc-tinh-chu-de.edit', [ 'id' => $item->id ]) }}" class="btn-sm btn btn-warning">Chỉnh sửa</a>                                   
                  <a onclick="return callDelete('{{ $item->title }}','{{ route( 'thuoc-tinh-chu-de.destroy', [ 'id' => $item->id ]) }}');" class="btn-sm btn btn-danger">Xóa</a>
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
  $('#id_chude').change(function(){
    $(this).parents('form').submit();
  })
});
</script>
@stop