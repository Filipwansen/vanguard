

<?php $__env->startSection('page-title', __('OCR Labeling')); ?>
<?php $__env->startSection('page-heading', __('OCR')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('OCR Labeling'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <iframe src="http://localhost/nvanguard/public/ocrlabeling" width="100%" style="min-height: 800px;"></iframe>
    <!-- <iframe src="<?php echo e(url('ocrlabeling')); ?>" width="100%" style="min-height: 800px;"></iframe> -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nvanguard\resources\views/ocr/index.blade.php ENDPATH**/ ?>