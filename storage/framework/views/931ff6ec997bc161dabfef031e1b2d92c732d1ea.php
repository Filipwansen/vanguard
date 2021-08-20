

<?php $__env->startSection('page-title', __('Company')); ?>
<?php $__env->startSection('page-heading', __('Company')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('View Company'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/toastr')); ?>/toastr.css"> 
<?php if($message=Session::get('notify')): ?>
<div class="alert alert-success alert-block col-md-4 offset-md-4">
    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
    <li><?php echo e($message); ?></li>       
</div>
<?php endif; ?>
<?php if($message=Session::get('error_notify')): ?>
<div class="alert alert-danger alert-block col-md-4 offset-md-4">
    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
    <li><?php echo e($message); ?></li>       
</div>
<?php endif; ?>
<?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
   <div class="card-body">
      <div class="row">
         <div class="col-md-3">
            <h5 class="card-title">
               <?php echo e(ucfirst($company->name)); ?> Company Details
            </h5>
            <p class="text-muted font-weight-light">
               <?php echo app('translator')->get('View registered company with the application.'); ?>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <label for="key">Key:</label>
                    <textarea class="form-control" row="2" readonly id="myInput"><?php echo e($company->key); ?></textarea>
                </div>
                <div class="col-md-12" style="text-align: right;">
                    <button class="btn btn-primary mt-1" onclick="myFunction()" style="padding: 5px;" title="Copy"><i class="fas fa-copy"></i></button>
                </div>
                
            </div>

            <div class="mt-2">
                <label for="expire_date">Expire Date:</label>
                <input type="text" class="form-control" value="<?php echo e($company->expire_date); ?>" readonly>
            </div>
         </div>
         <div class="col-md-9">

            <div class="form-group">
                <label for="name">Company Name: <?php echo '<b>'.$company->name.'</b>'; ?></label>                
            </div>                
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2"><label for="cif">CIF: <b><?php echo e($company->cif); ?></b></label></div>
                    <div class="col-md-8" style="text-align: center"><label for="address">Address: <b><?php echo e($company->address); ?></b></label></div>
                    <div class="col-md-2"><label for="address">Created: <b><?php echo e(date('Y-m-d', strtotime($company->created_at))); ?></b></label></div>                
                </div>
            </div>                
            <div class="form-group">
                <div class="row">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-2" style="padding-bottom: 10px;">
                        <a href="<?php echo e(url('users').'/'.$user->id); ?>">
                            <?php if(!empty($user->avatar)): ?>
                                <img class="rounded-circle img-responsive" width="40" src="<?php echo e(asset('upload/users').'/'.$user->avatar); ?>" alt="">
                            <?php else: ?> 
                                <img class="rounded-circle img-responsive" width="40" src="<?php echo e(asset('assets/img/profile.png')); ?>" alt="">
                            <?php endif; ?>
                            <div><?php echo e($user->username); ?></div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>                            
            <div class="form-group row">
                <div class="col-md-12" style="text-align: center">
                    <a class="btn btn-danger" href="<?php echo e(url('company')); ?>"><i class="fas fa-angle-double-left"></i> Back</a>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo HTML::script('assets/js/as/company.js'); ?>

    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Company\CompanyRequest', '#add-company-form'); ?>

    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            toastr.success("Copied!");
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nvanguard\resources\views/companies/view.blade.php ENDPATH**/ ?>