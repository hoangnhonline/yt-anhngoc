<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Thêm mới chi phí
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo e(route('cost.index')); ?>">Chi phí</a></li>
      <li class="active">Thêm mới</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default" href="<?php echo e(route('cost.index')); ?>" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="<?php echo e(route('cost.store')); ?>">
    <div class="row">
      <!-- left column -->
<?php 
$type = old('type', 0);
$department_id = old('department_id', 0);
$staff_id = old('staff_id', 0);
?>
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
                <div class="form-group" >                                    
                  <select name="staff_id" class="form-control select2" id="staff_id">
                    <option value="">-- Nhân viên --</option>    
                    <?php foreach($staffList as $staff): ?>                
                    <option value="<?php echo e($staff->id); ?>" <?php echo e($staff_id == $staff->id ? "selected" : ""); ?>><?php echo e($staff->name); ?> - <?php echo e($staff->staff_code); ?></option>
                    <?php endforeach; ?>                    
                  </select>
                </div>                
                <div class="form-group">
                  <input placeholder="Số tiền" type="text" class="form-control number" name="total_cost" id="total_cost" value="<?php echo e(old('total_cost')); ?>">
                </div>
                <div class="form-group">
                  <input placeholder="Ngày" type="text" class="form-control datepicker" name="date_use" id="date_use" value="<?php echo e(old('date_use')); ?>">
                </div>
                <div class="form-group">
                  <input placeholder="Số chứng từ" type="text" class="form-control" name="sct" id="sct" value="<?php echo e(old('sct')); ?>">
                </div>
                <div class="form-group">
                  <input placeholder="Nội dung" type="text" class="form-control" name="title" id="title" value="<?php echo e(old('title')); ?>">
                </div>
                <div class="form-group">                  
                  <textarea class="form-control" rows="6" name="detail" id="detail"><?php echo e(old('detail')); ?></textarea>
                </div>
                  
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="<?php echo e(route('cost.index')); ?>">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-5">

      </div>
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<style type="text/css">
  .select2-container--default .select2-selection--single{
    height: 36px !important;

  }
  .select2-container .select2-selection--single .select2-selection__rendered{
    padding-left: 0px !important;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">
    $(document).ready(function(){
      $('input.number').number( true, 0);
      $(".select2").select2();      
      var editor = CKEDITOR.replace( 'detail',{
          language : 'vi',         
          toolbarGroups : [
              { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
              { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
              { name: 'document', groups: [ 'mode', 'document', 'doctools', 'clipboard', 'undo', 'find', 'selection', 'spellchecker', 'editing'] },
              { name: 'forms', groups: [ 'forms' ] },               
              { name: 'links', groups: [ 'links' ] },
              { name: 'insert', groups: [ 'insert' ] },          
              { name: 'styles', groups: [ 'styles' ] },
              { name: 'colors', groups: [ 'colors' ] },
              { name: 'tools', groups: [ 'tools' ] },
              { name: 'others', groups: [ 'others' ] },
              { name: 'about', groups: [ 'about' ] }
            ],
            removeButtons :'Source,Templates,Save,Find,SelectAll,Scayt,Form,Strike,Checkbox,Radio,TextField,Replace,Print,Preview,NewPage,Textarea,Select,Button,ImageButton,HiddenField,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Image,Flash,Smiley,SpecialChar,Iframe,Maximize,About,Subscript,Superscript,CopyFormatting,RemoveFormat,Outdent,Indent,PageBreak,FontSize,Font,Format,Styles,ShowBlocks'
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
    });
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>