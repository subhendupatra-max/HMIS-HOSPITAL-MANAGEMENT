<div id="message">
<?php if(session('success')): ?>
<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session()->has('error')): ?>
<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
<?php endif; ?>
</div>

<script>
setTimeout(function(){
  document.getElementById('message').style.display = 'none';
}, 4000);
</script><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/message/notification.blade.php ENDPATH**/ ?>