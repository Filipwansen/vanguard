

<?php $__env->startSection('page-title', __('Company')); ?>
<?php $__env->startSection('page-heading', __('Company')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Edit Company'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
               Company Details
            </h5>
            <p class="text-muted font-weight-light">
               Update registeration for company with the application.
            </p>
         </div>
         <div class="col-md-9">
            <form action="<?php echo e(url('update/company').'/'.$company->id); ?>" 
                  method="post" 
                  enctype="multipart/form-data" 
                  novalidate="novalidate" 
                  accept-charset="UTF-8" 
                  autocomplete="off"
                  id="update-company-form"
                  >
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="name">Company Name</label>
                    <input  type="text" 
                            class="form-control input-solid" 
                            id="name" 
                            placeholder="(Company Name)" 
                            name="name"                            
                            value="<?php echo e($company->name); ?>">
                </div>                
                <div class="form-group">
                    <label for="cif">CIF</label>
                    <input type="text" class="form-control input-solid" id="cif" placeholder="CIF" name="cif" value="<?php echo e($company->cif); ?>">
                </div>                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control input-solid" id="address" placeholder="Address" name="address" value="<?php echo e($company->address); ?>">
                </div>   
                <!--  -->
                <div class="form-group">
                    <label for="usersa">Users</label>
                    <div class="form-group">
                        <select id="users" multiple="multiple">
                            <?php $__currentLoopData = \Vanguard\User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php if($user->company_id==$company->id): ?> selected <?php endif; ?>><?php echo e($user->username); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input type="text" name="users" style="opacity:0">
                    </div>
                </div>  
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="btn-company">Update Company</button>
                    <a class="btn btn-danger" href="<?php echo e(url('company')); ?>"><i class="fas fa-angle-double-left"></i> Back</a>
                </div>
            </form>            
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo HTML::script('assets/js/as/company.js'); ?>

    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyRequest', '#update-company-form'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#users').multiselect({
                onDropdownShow: function(event) {
                                    console.log('Dropdown shown.');
                                    $('.content-page').css('overflow','');
                                }
            });
        });

        $('#update-company-form').on('submit', function(e){
            let ss = $('#users').val();
            $('input[name="users"]').val(ss);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nvanguard\resources\views/companies/edit.blade.php ENDPATH**/ ?>