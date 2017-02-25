<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tạo tài khoản
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo e(route('account.index')); ?>">Tài khoản</a></li>
      <li class="active">Tạo mới</li>
    </ol>
  </section>
<?php 
$type = old('type', 0);
$department_id = old('department_id', 0);
$area_id = old('area_id', 0);
?>
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="<?php echo e(route('account.index')); ?>" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="<?php echo e(route('account.store')); ?>" id="formData">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tạo mới</h3>
          </div>
          <!-- /.box-header -->               
            <?php echo csrf_field(); ?>


            <div class="box-body">
              <?php if(count($errors) > 0): ?>
                  <div class="alert alert-danger">
                      <ul>
                          <?php foreach($errors->all() as $error): ?>
                              <li><?php echo e($error); ?></li>
                          <?php endforeach; ?>
                      </ul>
                  </div>
              <?php endif; ?>
                 
                 <!-- text input -->
                <div class="form-group">                  
                  <input type="text" placeholder="Họ tên" class="form-control"  name="full_name" id="full_name" value="<?php echo e(old('full_name')); ?>">
                </div>
                 <div class="form-group">                  
                  <input type="text" placeholder="Email" class="form-control" name="email" id="email" value="<?php echo e(old('email')); ?>">
                </div>  
                <div class="form-group" >                  
                  <select name="type" class="form-control select2" id="type">
                    <option value="">-- Phân loại --</option>                    
                    <option value="1" <?php echo e($type == 1 ? "selected" : ""); ?>>Văn phòng</option>
                    <option value="2" <?php echo e($type == 2 ? "selected" : ""); ?>>Nhà máy</option>
                  </select>
                </div>
                <div class="form-group" >                  
                  <select name="department_id" class="form-control select2" id="department_id">
                    <option value="">-- Phòng ban --</option>    
                    <?php foreach($departmentList as $depart): ?>                
                    <option value="<?php echo e($depart->id); ?>" <?php echo e($department_id == $depart->id ? "selected" : ""); ?>><?php echo e($depart->name); ?></option>
                    <?php endforeach; ?>                    
                  </select>
                </div>              
                <div class="form-group">                  
                  <select class="form-control" name="role" id="role"> 
                    <option value="">-- Chức vụ --</option>                            
                    <option value="1" <?php echo e(old('role') == 1 ? "selected" : ""); ?>>Nhân viên</option>                  
                    <option value="2" <?php echo e(old('role') == 2 ? "selected" : ""); ?>>Giám đốc KV</option>
                  </select>
                </div>  
                <div class="form-group">                  
                  <select class="form-control" name="role" id="role"> 
                    <option value="">-- Khu vực --</option>                            
                    <?php foreach($areaList as $area): ?>                
                    <option value="<?php echo e($area->id); ?>" <?php echo e($area_id == $area->id ? "selected" : ""); ?>><?php echo e($area->name); ?></option>
                    <?php endforeach; ?> 
                  </select>
                </div>                            
                <div class="form-group">                  
                  <select class="form-control" name="status" id="status">                                     
                  <option value="">-- Trạng thái --</option>   
                    <option value="1" <?php echo e(old('status') == 1 ? "selected" : ""); ?>>Mở</option>                  
                    <option value="2" <?php echo e(old('status') == 2 ? "selected" : ""); ?>>Khóa</option>                    
                  </select>
                </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="<?php echo e(route('account.index')); ?>">Hủy</a>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">
    $(document).ready(function(){
      $('#formData').submit(function(){
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
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
    });
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>