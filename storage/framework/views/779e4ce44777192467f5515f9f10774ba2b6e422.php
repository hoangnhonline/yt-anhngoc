<option value="">-- Nhân viên --</option>
<?php if($items->count() > 0): ?>
	<?php foreach($items as $item): ?>
	<option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
	<?php endforeach; ?>
<?php endif; ?>