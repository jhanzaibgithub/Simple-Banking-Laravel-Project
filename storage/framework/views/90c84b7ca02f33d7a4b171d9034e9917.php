<?php $__env->startSection('content'); ?>
<div class="container mt-5 w-50">
    <div class="card">
        <div class="card-header">
            Withdraw Money
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('withdraw')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="amount" class="form-label"> <b>Amount</b></label>
                    <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
                </div>
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Withdraw</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_10_ajax_crud\resources\views/account/withdraw.blade.php ENDPATH**/ ?>