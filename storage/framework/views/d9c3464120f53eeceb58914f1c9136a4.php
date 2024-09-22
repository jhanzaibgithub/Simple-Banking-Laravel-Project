<?php $__env->startSection('content'); ?>





<div class="container my-4 w-50">
    <h3>Statement of account</h3>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>DateTime</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Details</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                  <td><?php echo e($transaction->created_at); ?></td>
                  <td><?php echo e($transaction->amount); ?></td>

                <td><?php echo e($transaction->type); ?></td>
                <td>
                    <?php if($transaction->type == 'transfer'): ?>
                        Transfer to <br> <?php echo e($transaction->receiver_email); ?>

                        <?php else: ?>
                        <?php echo e($transaction->type); ?> <!-- Show the type for non-transfer transactions -->
                        <?php endif; ?>
                    </td>
                <td><?php echo e($transaction->after_balance); ?></td>


                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>


</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_10_ajax_crud\resources\views/account/statement.blade.php ENDPATH**/ ?>