@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Link video
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'link-video.index' ) }}">Link video</a></li>
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
      <a href="{{ route('link-video.create') }}" class="btn btn-info" style="margin-bottom:5px">Tạo / Sửa / Nhập link</a>
      
       <div class="panel panel-default">        
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('link-video.index') }}">                        
            <div class="form-group">              
              <label for="id_chude">Email upload</label>
              <select name="id_mail" class="form-control select2" id="id_mail">
                <option value="">- Tất cả -</option>                   
                @foreach($mailList as $mail)                
                <option value="{{ $mail->id }}" {{ $search['id_mail'] == $mail->id ? "selected" : "" }}>{{ $mail->email }}</option>
                @endforeach                    
              </select>
            </div>
            @if(Auth::user()->role == 3)
            <div class="form-group">              
              <label for="id_chude">&nbsp;&nbsp;Account</label>
              <select name="user_id" class="form-control select2" id="user_id">  
                <option value="">- Tất cả -</option>                                    
                @foreach($userList as $user)                
                <option value="{{ $user->id }}" {{ $search['user_id'] == $user->id ? "selected" : "" }}>{{ $user->full_name }}</option>
                @endforeach                    
              </select>
            </div>            
            @endif
            <div class="form-group">              
              <label for="id_chude">&nbsp;&nbsp;Chủ đề</label>
              <select name="id_chude" class="form-control select2" id="id_chude">
                <option value="">- Tất cả -</option>                                      
                @foreach($chudeList as $chude)                
                <option value="{{ $chude->id }}" {{ $search['id_chude'] == $chude->id ? "selected" : "" }}>{{ $chude->ten }}</option>
                @endforeach                    
              </select>
            </div> 
            <div class="form-group ">    
                  <label for="ten">&nbsp;&nbsp;&nbsp;&nbsp;Từ STT</label>              
                  <input type="text" class="form-control"  style="width:80px" name="stt_fm" id="stt_fm" value="{{ $search['stt_fm'] }}">
                </div>
              <div class="form-group" >    
                  <label for="ten">&nbsp;&nbsp;&nbsp;&nbsp;Đến STT</label>              
                  <input type="text" class="form-control"  style="width:80px" name="stt_to" id="stt_to" value="{{ $search['stt_to'] }}">
                </div>          
            <button type="submit" class="btn btn-primary">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( {{ $items->count() > 0 ? $items->total() : 0 }} )</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">          
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                                         
              <th>Tên</th>
              <th>Link</th> 
              <th>Chủ đề</th> 
              <th>Email upload</th>
              <th>Account tạo</th>                                         
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>               
                <td>
                @if($item->link)
                  <a href="{{ $item->link }}" target="_blank">
                @endif
                {{ $item->name }}
                @if($item->link)
                  </a>
                @endif
                </td>
                <td>@if($item->link)
                <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
                @endif</td>
                <td>                
                  {{ $chudeNameArr[$item->id_chude] }}
                </td>
                <td>
                  @if($item->id_mail > 0)
                  {{ $mailNameArr[$item->id_mail] }}
                  @endif
                </td>
                <td>
                @if($item->updated_user > 1)
                {{ $userNameArr[$item->updated_user] }}
                @else
                Admin
                @endif
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
          @if($items->count() > 0)
           <div style="text-align:center">
            {{ $items->appends( $search )->links() }}
          </div> 
          @endif
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
  $('#id_chude, #id_mail, #user_id').change(function(){
    $(this).parents('form').submit();
  })
});
</script>
@stop