<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Thông tin chi phí
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo e(route( 'cost.index' )); ?>">Thông tin chi phí</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php if(Session::has('message')): ?>
      <p class="alert alert-info" ><?php echo e(Session::get('message')); ?></p>
      <?php endif; ?>
      <?php if(Auth::user()->role == 3): ?>
      <a href="<?php echo e(route('cost.create')); ?>" class="btn btn-info" style="margin-bottom:5px">Thêm mới</a>
      <?php endif; ?>
      <div class="panel panel-default">        
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="<?php echo e(route('cost.index')); ?>">                        
            <?php if(Auth::user()->role == 3): ?>
            <div class="form-group">              
              <select name="type" class="form-control select2" id="type">
                <option value="">-- Phân loại --</option>
                <option value="1" <?php echo e($search['type'] == 1 ? "selected" : ""); ?>>Văn phòng</option>
                <option value="2" <?php echo e($search['type'] == 2 ? "selected" : ""); ?>>Nhà máy</option>
              </select>
            </div>            
            <div class="form-group">              
              <select name="department_id" class="form-control select2" id="department_id">
                <option value="">-- Phòng ban --</option>    
                <?php foreach($departmentList as $depart): ?>                
                <option value="<?php echo e($depart->id); ?>" <?php echo e($search['department_id'] == $depart->id ? "selected" : ""); ?>><?php echo e($depart->name); ?></option>
                <?php endforeach; ?>                    
              </select>
            </div>
            <div class="form-group">              
              <select name="staff_id" class="form-control select2" id="staff_id">
                <option value="">-- Nhân viên --</option>    
                <?php foreach($staffList as $staff): ?>                
                <option value="<?php echo e($staff->id); ?>" <?php echo e($search['staff_id'] == $staff->id ? "selected" : ""); ?>><?php echo e($staff->name); ?> - <?php echo e($staff->staff_code); ?></option>
                <?php endforeach; ?>                    
              </select>
            </div>
            <?php endif; ?>
            <div class="form-group">              
              <input type="text" class="form-control" name="sct" placeholder="Số chứng từ" value="<?php echo e($search['sct']); ?>" style="width:120px">
            </div>
            <div class="form-group">              
              <input type="text" class="form-control datepicker" name="fd" placeholder="Từ ngày" value="<?php echo e($search['fd']); ?>" style="width:100px">
            </div>
            <div class="form-group">              
              <input type="text" class="form-control datepicker" name="td" placeholder="Đến ngày" value="<?php echo e($search['td']); ?>" style="width:100px">
            </div>
            <button type="submit" class="btn btn-primary">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách [ <span class="value"><?php echo e($items->total()); ?> </span>] - Tổng tiền: <span style="color:red"><?php echo e(number_format($total)); ?></span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
            
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                            
              <?php if(Auth::user()->role == 3): ?>
              <th>Phân loại</th>
              <th>Phòng ban</th>
              <th>Nhân viên</th>
              <?php endif; ?>
              <th>Ngày</th>              
              <th>Số chứng từ</th>
              <th>Nội dung</th>
              <th style="text-align:right">Số tiền</th>
              <?php if(Auth::user()->role == 3): ?>
              <th width="1%;white-space:nowrap">Thao tác</th>
              <?php endif; ?>
            </tr>
            <tbody>
            <?php if( $items->count() > 0 ): ?>
              <?php $i = 0; ?>
              <?php foreach( $items as $item ): ?>
                <?php $i ++; ?>
              <tr id="row-<?php echo e($item->id); ?>">
                <td><span class="order"><?php echo e($i); ?></span></td>
                <?php if(Auth::user()->role == 3): ?> 
                <td><?php echo e($item->type == 1 ? "Văn phòng" : "Nhà máy"); ?></td>
                <td><?php echo e($item->department_name); ?></td>
                <td><?php echo e($item->full_name); ?></td>
                <?php endif; ?>
                <td><?php echo e(date('d-m-Y', strtotime($item->date_use))); ?></td>                
                <td><?php echo e($item->sct); ?></td>
                <td><?php echo e($item->title); ?></td>
                <td style="text-align:right"><?php echo e(number_format($item->total_cost)); ?></td>
                <?php if(Auth::user()->role == 3): ?>
                <td style="white-space:nowrap">                                
                  <a href="<?php echo e(route( 'cost.edit', [ 'id' => $item->id ])); ?>" class="btn btn-warning">Chỉnh sửa</a>                                   
                  <a onclick="return callDelete('<?php echo e($item->title); ?>','<?php echo e(route( 'cost.destroy', [ 'id' => $item->id ])); ?>');" class="btn btn-danger">Xóa</a>
                </td>
                <?php endif; ?>
              </tr> 
              <?php endforeach; ?>
            <?php else: ?>
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            <?php endif; ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
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
<?php 
$department_id = $search['department_id'];
$staff_id = $search['staff_id'];
$type = $search['type'];
?>
$(document).ready(function(){
  $('#type').change(function(){
        var type = $(this).val();
        $.ajax({
            url: '<?php echo e(route('department.ajax-list')); ?>',
            type: "GET",
            async: false,
            data: {                         
                type : type
            },
            success: function(data){
                $('#department_id').html(data).select2('refresh');
            }
        });
      });     
      $('#department_id').change(function(){
        var department_id = $(this).val();
        $.ajax({
            url: '<?php echo e(route('account.ajax-list')); ?>',
            type: "GET",
            async: false,
            data: {                         
                department_id : department_id
            },
            success: function(data){
                $('#staff_id').html(data).select2('refresh');
            }
        });
      });

      <?php if($type > 0): ?>
      $.ajax({
            url: '<?php echo e(route('department.ajax-list')); ?>',
            type: "GET",
            async: false,
            data: {                         
                type : <?php echo e($type); ?>

            },
            success: function(data){
                <?php if($department_id > 0): ?>
                $('#department_id').html(data).val(<?php echo e($department_id); ?>).select2('refresh');               
                <?php else: ?> 
                $('#department_id').html(data).select2('refresh');               
                <?php endif; ?>
            }
        });
      <?php endif; ?>      
      <?php if($department_id > 0): ?>
        $.ajax({
              url: '<?php echo e(route('account.ajax-list')); ?>',
              type: "GET",
              async: false,
              data: {                         
                  department_id : <?php echo e($department_id); ?>

              },
              success: function(data){
                  <?php if($staff_id > 0): ?>
                  $('#staff_id').html(data).val(<?php echo e($staff_id); ?>).select2('refresh');               
                  <?php else: ?> 
                  $('#staff_id').html(data).select2('refresh');               
                  <?php endif; ?>
              }
          });
        <?php endif; ?>
  $('.select2').select2();

 
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>