

<?php $__env->startSection('page-title', __('Company')); ?>
<?php $__env->startSection('page-heading', __('Company')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Company'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
        <div class="row my-3 flex-md-row flex-column-reverse">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <a href="<?php echo e(route('add.company')); ?>" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>Add Company</a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="company" class="table table-borderless table-striped table-dashboard">
            <thead>
                <tr>
                    <th class="min-width-80">No</th>
                    <th class="min-width-150">Company Name</th>
                    <th class="min-width-100">Address</th>
                    <th class="min-width-80">CIF</th>
                    <th class="min-width-80">Users</th>
                    <th class="min-width-80">Registration Date</th>
                    <th class="text-center min-width-150">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="width: 40px;"><?php echo e($key+1); ?></td>
                    <td class="align-middle"><?php echo e(ucfirst($company->name)); ?></td>
                    <td class="align-middle"><?php echo e(ucfirst($company->address)); ?></td>
                    <td class="align-middle"><?php echo e(ucfirst($company->cif)); ?></td>
                    <td class="align-middle"><?php echo e(\Vanguard\User::where('company_id', $company->id)->count()); ?></td>
                    <td class="align-middle"><?php echo e(date('Y-m-d H:i', strtotime($company->created_at))); ?></td>
                    <td class="text-center align-middle">
                        <a href="<?php echo e(url('company').'/'.$company->id.'/view'); ?>" class="btn btn-icon" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Company">
                            <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="<?php echo e(url('company').'/'.$company->id.'/edit'); ?>" class="btn btn-icon edit" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit Company">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?php echo e(url('company').'/'.$company->id); ?>" class="btn btn-icon" title="" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to delete this company?" data-confirm-delete="Yes, delete it!" data-original-title="Delete Company">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
            </tbody>
            </table>
        </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- DataTables -->
<script type="text/javascript">
    $(function () {
        $('#company').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nvanguard\resources\views/companies/index.blade.php ENDPATH**/ ?>