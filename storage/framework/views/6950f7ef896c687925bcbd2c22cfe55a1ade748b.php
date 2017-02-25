<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Chủ đề
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo e(route( 'chu-de.index' )); ?>">Chủ đề</a></li>
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
      <a href="<?php echo e(route('chu-de.create')); ?>" class="btn btn-info" style="margin-bottom:5px">Tạo mới</a>
      
      
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách </h3>
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
            <?php if( $items->count() > 0 ): ?>
              <?php $i = 0; ?>
              <?php foreach( $items as $item ): ?>
                <?php $i ++; ?>
              <tr id="row-<?php echo e($item->id); ?>">
                <td><span class="order"><?php echo e($i); ?></span></td>               
                <td><?php echo e($item->ten); ?></td>               
              
                <td style="white-space:nowrap">                                
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('thuoc-tinh-chu-de.index', ['id_chude' => $item->id])); ?>" ><span class="badge">
                    <?php echo e($item->thuocTinh->count()); ?>

                  </span> Thuộc tính </a>
                  <a href="<?php echo e(route( 'chu-de.edit', [ 'id' => $item->id ])); ?>" class="btn-sm btn btn-warning">Chỉnh sửa</a>                                   
                  <a onclick="return callDelete('<?php echo e($item->title); ?>','<?php echo e(route( 'chu-de.destroy', [ 'id' => $item->id ])); ?>');" class="btn-sm btn btn-danger">Xóa</a>
                </td>              
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>