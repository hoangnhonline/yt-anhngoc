@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Tài khoản
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('account.index') }}">Tài khoản</a></li>
      <li class="active">Chỉnh sửa</li>
    </ol>
  </section>
<?php 
$type = old('type', $detail->type);
$department_id = old('department_id', $detail->department_id);
$area_id = old('area_id', $detail->area_id);
?>
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('account.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('account.update') }}" id="formData">
    <div class="row">
      <!-- left column -->
      <input type="hidden" name="id" value="{{ $detail->id }}"> 
      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Chỉnh sửa</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                 
                <!-- text input -->
                <div class="form-group">                  
                  <input type="text" placeholder="Tên" class="form-control"  name="full_name" id="full_name" value="{{ old('full_name', $detail->full_name) }}">
                </div>
                 <div class="form-group">                  
                  <input type="text" readonly="true" placeholder="Email" class="form-control" name="email" id="email" value="{{ old('email', $detail->email) }}">
                </div> 
                <div class="form-group">      
                  <label for="full_name">Lời nhắc</label>             
                  <textarea class="form-control" rows="6" name="remarks">{{ old('remarks', $detail->remarks) }}</textarea>
                </div>   
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('account.index')}}">Hủy</a>
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
