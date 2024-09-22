<?php $__env->startSection('content'); ?>
<div class="container mt-5 w-50">
    <div class="card text-center">
        <div class="card-header">
            <span> Welcome </span> <span><b><?php echo e($users->name); ?></b></span>

        </div>
        <div class="card-body">
            <p class="card-text">Your ID: <?php echo e($users->email); ?></p>
            <h4>Your Balance: <span class="text-success"><?php echo e($account->balance ?? 0); ?></span></h4>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_10_ajax_crud\resources\views/account/home.blade.php ENDPATH**/ ?>