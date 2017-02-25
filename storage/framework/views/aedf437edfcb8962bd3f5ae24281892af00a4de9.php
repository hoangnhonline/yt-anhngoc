<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Thêm mới công nợ
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo e(route('bill.index')); ?>">Công nợ</a></li>
      <li class="active">Thêm mới</li>
    </ol>
  </section>
<?php
$customer_id = old('customer_id', 0);
?>
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="<?php echo e(route('bill.index')); ?>" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="<?php echo e(route('bill.store')); ?>" id="formData">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thêm mới</h3>
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
                <div class="form-group">                  
                  <select class="form-control" name="customer_id" id="customer_id"> 
                    <option value="">-- Khách hàng --</option>                            
                    <?php foreach($customerList as $customer): ?>                
                    <option value="<?php echo e($customer->id); ?>" <?php echo e($customer_id == $customer->id ? "selected" : ""); ?>><?php echo e($customer->company_name); ?></option>
                    <?php endforeach; ?> 
                  </select>
                </div> 
                <div class="form-group">                  
                  <input type="text" placeholder="Số hóa đơn" class="form-control"  name="bill_no" id="bill_no" value="<?php echo e(old('bill_no')); ?>">
                </div> 
                <div class="form-group">                  
                  <input type="text" placeholder="Ngày xuất hóa đơn" class="form-control datepicker"  name="date_export" id="date_export" value="<?php echo e(old('date_export')); ?>">
                </div>
                <div class="form-group">                  
                  <input type="text" placeholder="Tiền hàng" class="form-control number"  name="product_cost" id="product_cost" value="<?php echo e(old('product_cost')); ?>">
                </div>
                <div class="form-group">                  
                  <input type="text" placeholder="Tiền thuế" class="form-control number"  name="tax" id="tax" value="<?php echo e(old('tax')); ?>">
                </div>
                 <div class="form-group">                  
                  <input type="text" placeholder="Tổng tiền" class="form-control number" name="total_cost" id="total_cost" value="<?php echo e(old('total_cost')); ?>">
                </div>
                <div class="form-group">                  
                  <input type="text" placeholder="Đã trả" class="form-control number" name="pay" id="pay" value="<?php echo e(old('pay')); ?>">
                </div>
                <div class="form-group">                  
                  <input type="text" placeholder="Còn nợ lại" class="form-control" name="owed" id="owed" value="<?php echo e(old('owed')); ?>">
                </div>
             
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="<?php echo e(route('bill.index')); ?>">Hủy</a>
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