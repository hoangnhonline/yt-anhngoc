<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cập nhật khách hàng
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo e(route('customer.index')); ?>">Khách hàng</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>
<?php
$area_id = old('area_id', $detail->area_id);
?>
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="<?php echo e(route('customer.index')); ?>" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="<?php echo e(route('customer.update')); ?>" id="formData">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cập nhật</h3>
          </div>
          <!-- /.box-header -->               
            <?php echo csrf_field(); ?>

            <input type="hidden" name="id" value="<?php echo e($detail->id); ?>">
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
                <div class="form-group">                  
                  <select class="form-control" name="area_id" id="area_id"> 
                    <option value="">-- Khu vực --</option>                            
                    <?php foreach($areaList as $area): ?>                
                    <option value="<?php echo e($area->id); ?>" <?php echo e($area_id == $area->id ? "selected" : ""); ?>><?php echo e($area->name); ?></option>
                    <?php endforeach; ?> 
                  </select>
                </div> 
                <div class="form-group">                  
                  <input type="text" placeholder="Tên CTY" class="form-control"  name="company_name" id="company_name" value="<?php echo e(old('company_name', $detail->company_name)); ?>">
                </div> 
                <div class="form-group">                  
                  <input type="text" placeholder="Mã số thuế" class="form-control"  name="tax_no" id="tax_no" value="<?php echo e(old('tax_no', $detail->tax_no)); ?>">
                </div>
                <div class="form-group">                  
                  <input type="text" placeholder="Người đại diện" class="form-control"  name="name" id="name" value="<?php echo e(old('name', $detail->name)); ?>">
                </div>
                <div class="form-group">                  
                  <input type="text" placeholder="Số điện thoại" class="form-control"  name="phone" id="phone" value="<?php echo e(old('phone', $detail->phone)); ?>">
                </div>
                 <div class="form-group">                  
                  <input type="text" placeholder="Email ( dùng để đăng nhập )" readonly="true" class="form-control" name="email" id="email" value="<?php echo e($detail->email); ?>">
                </div>                 
                <input type="hidden" name="type" value="2">
                <div class="form-group">                  
                  <select class="form-control" name="status" id="status">                                     
                  <option value="">-- Trạng thái --</option>   
                    <option value="1" <?php echo e(old('status', $detail->status) == 1 ? "selected" : ""); ?>>Mở</option>                  
                    <option value="2" <?php echo e(old('status', $detail->status) == 2 ? "selected" : ""); ?>>Khóa</option>
                  </select>
                </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="<?php echo e(route('customer.index')); ?>">Hủy</a>
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
    });    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>