@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cập nhật chủ đề
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('thuoc-tinh-chu-de.index') }}">Thuộc tính chủ đề</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('thuoc-tinh-chu-de.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('thuoc-tinh-chu-de.update') }}" id="formData">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cập nhật</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $detail->id }}">
            <div class="box-body">
              @include('message')
                <div class="form-group" >    
                <label for="ten">Chủ đề</label> 
                <select name="id_chude" class="form-control select2" id="id_chude">
                  <option value="">-- Chọn chủ đề --</option>    
                  @foreach($chudeList as $chude)                
                  <option value="{{ $chude->id }}" {{ old('id_chude', $detail->id_chude) == $chude->id ? "selected" : "" }}>{{ $chude->ten }}</option>
                  @endforeach                    
                </select>
              </div> 
                <div class="form-group">  
                  <label for="ten">Tên thuộc tính</label>                
                  <input type="text" class="form-control"  name="ten" id="ten" value="{{ old('ten', $detail->ten) }}">
                </div>                
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('thuoc-tinh-chu-de.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@stop
@section('javascript_page')
<script type="text/javascript">
    $(document).ready(function(){
      $('#formData').submit(function(){
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
    });    
</script>
@stop
