@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý link video
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('link-video.index') }}">Link video</a></li>      
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('link-video.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('link-video.store') }}" id="formData">
    <input type="hidden" name="buoc" value="{{ $buoc }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">          
          <!-- /.box-header -->               
            {!! csrf_field() !!}
            @include('message')
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
              <div class="form-group col-md-2" style="padding-left:0px">    
                  <label for="ten">Bước</label>              
                  <select class="form-control" name="buoc" id="buoc">
                      <option value="1" {{ $buoc == 1 ? "selected"  : "" }}>Tạo / Sửa</option>
                      <option value="2" {{ $buoc == 2 ? "selected"  : "" }}>Nhập Link</option>
                  </select>
                </div>
              <div class="form-group col-md-3" style="padding-left:0px">    
                  <label for="ten">Từ STT</label>              
                  <input type="text" class="form-control"  name="stt_fm" id="stt_fm" value="{{ $stt_fm }}">
                </div>
              <div class="form-group col-md-3" >    
                  <label for="ten">Đến STT</label>              
                  <input type="text" class="form-control"  name="stt_to" id="stt_to" value="{{ $stt_to }}">
                </div>  
              <div class="form-group col-md-3" style="padding-right:0px">    
                <label for="ten">Chủ đề</label> 
                <select name="id_chude" class="form-control select2" id="id_chude">
                  <option value="">-- Chọn chủ đề --</option>    
                  @foreach($chudeList as $chude)                
                  <option value="{{ $chude->id }}" {{ $id_chude == $chude->id ? "selected" : "" }}>{{ $chude->ten }}</option>
                  @endforeach                    
                </select>

                
              </div>   
              <div class="col-md-1 form-group">
              <label>&nbsp;</label>
              <button class="btn-primary form-control" id="btnLoad" type="button">Load</button>
              </div>
              @if($buoc > 0 && $stt_fm > 0 && $stt_to > 0)
              <div id="load-data" class="col-md-12" style="padding-left:0px;padding-right:0px">

                  <table class="table table-striped table-bordered" id="dataTbl">
                    <thead>
                      <tr>
                        <td>STT</td>
                        <td style="width:240px">Tên</td>
                        @if($buoc == 1)
                        @foreach($thuocTinhList as $thuocTinh)
                        <td  style="width:40px">{{ $thuocTinh->ten }}</td>     
                        @endforeach
                        @else
                        <td width="150px">
                          Time (s)
                          </td>
                          <td width="250px">
                          Link
                          </td>
                        @endif
                        <td style="width:210px">Ghi chú</td>
                      </tr>
                    </thead>
                    <tbody>
                      @if($dataList->count() == 0)
                        @for($i = $stt_fm ; $i <= $stt_to; $i ++)
                        <tr>
                          <td width="1%" style="text-align:center">{{ $i }}
                          <input type="hidden" name="id[]" value="0">
                          <input type="hidden" name="stt[]" value="{{ $i }}">
                          </td>
                          @if($buoc == 1)
                          <td><input type="text" class="form-control" placeholder="Tên" name="ten[]" style="width:230px"></td>
                           @foreach($thuocTinhList as $thuocTinh)                         
                          <td style="width:40px;text-align:center"><input type="checkbox" class="thuoc_tinh">
                          <input type="hidden" name="thuoctinh[{{ $thuocTinh->id}}][]" value="0" title="{{ $thuocTinh->ten }}">
                          </td>    
                            @endforeach
                          @else
                          <td width="150px">
                          <input type="text" class="form-control" placeholder="Time" name="duration[]" value="">
                          </td>
                          <td width="250px">
                          <input type="text" class="form-control" placeholder="Link" name="link[]" value="">
                          </td>
                          
                          @endif
                          <td><input type="text" class="form-control" placeholder="Ghi chú" name="notes[]" style="width:200px"></td>
                        </tr>
                        @endfor
                      @else
                        @for($i = $stt_fm ; $i <= $stt_to; $i ++)
                        <tr>
                          <td width="1%" style="text-align:center">{{ $i }}
                          <input type="hidden" name="id[]" value="{{ isset($dataArr[$i]) ? $dataArr[$i]->id : 0 }} ">
                          <input type="hidden" name="stt[]" value="{{ $i }}">
                          </td>
                          <td><input type="text" class="form-control" placeholder="Tên" name="ten[]" style="width:230px" value="{{
                          isset($dataArr[$i]) ? $dataArr[$i]->name : "" }}"></td>
                          @if($buoc == 1)
                          <?php
                         $checkedArr =  isset($dataArr[$i]) ?  explode(',', $dataArr[$i]->str_id_thuoctinh) : [];
                          ?>
                           @foreach($thuocTinhList as $thuocTinh)                         
                          <td style="width:40px;text-align:center"><input type="checkbox" class="thuoc_tinh" {{
                            in_array($thuocTinh->id, $checkedArr) ? "checked" : ""
                            }} title="{{ $thuocTinh->ten }}">
                          <input type="hidden" name="thuoctinh[{{ $thuocTinh->id}}][]" value="{{
                            in_array($thuocTinh->id, $checkedArr) ? "1" : "0"
                            }}" >
                          </td>    
                            @endforeach
                          @else
                          <td width="150px">
                          <input type="text" class="form-control" placeholder="Time" name="duration[]" value="{{ isset($dataArr[$i]) ? $dataArr[$i]->duration : ""}}">
                          </td>
                          <td width="250px">
                          <input type="text" class="form-control" placeholder="Link" name="link[]" value="{{ isset($dataArr[$i]) ? $dataArr[$i]->link : "" }}">
                          </td>
                          @endif
                          <td><input type="text" class="form-control" placeholder="Ghi chú" name="notes[]" value="{{ isset($dataArr[$i]) ? $dataArr[$i]->notes : "" }}" style="width:200px"></td>
                        </tr>
                        @endfor
                      @endif
                      <input type="hidden" name="str_id_thuoctinh" value="{{ $str_id_thuoctinh }}">
                      
                    </tbody>
                  </table>
              </div>
              @endif
             
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('link-video.index')}}">Hủy</a>
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
<style type="text/css">

</style>
@stop
@section('javascript_page')
<script type="text/javascript">
function loadView(){
  var stt_fm = parseInt($('#stt_fm').val());
  var stt_to = parseInt($('#stt_to').val());

  var id_chude = $('#id_chude').val();
  var buoc = $('#buoc').val();
  
  if(stt_fm <= 0 || stt_to <= 0){
    alert('STT bắt buộc >= 1');return false;
  }
  /*
  var ok = true;
  $.ajax({
    url : '{{ route('check-stt') }}',
    type : 'POST',
    data : {
      stt_fm : stt_fm,
      stt_to : stt_to
    },
    success : function(data){
      if(data != 'OK'){
        alert('Số thứ tự phải bắt đầu từ ' + data);
        ok = false;
      }
    }
  });  
  */
  
  if($('#id_chude').val() == ''){
    alert('Bạn chưa chọn chủ đề.'); return false;
  }
  
  location.href= "{{ route('link-video.create') }}?stt_fm=" + stt_fm + '&stt_to=' + stt_to + '&id_chude=' + id_chude + '&buoc=' + buoc; 
}
    $(document).ready(function(){
      $("input[type=text]").keydown(function (e) {
        if (e.keyCode == 13) {
          return false;
        }
      });
      $('#buoc').change(function(){
        loadView();
      });
      $('#formData').submit(function(){
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
      $('.thuoc_tinh').click(function(){
        if($(this).prop('checked') == true){
          $(this).next().val(1);
        }else{
          $(this).next().val(0);
        }
      });
      $('#btnLoad').click(function(){        
        loadView();
      });
    });    
</script>
@stop
