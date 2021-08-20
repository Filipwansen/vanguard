<nav class="col-md-2 sidebar">
    <div class="user-box text-center pt-5 pb-3">
        <div class="user-img">
            <img src="<?php echo e(auth()->user()->present()->avatar); ?>"
                 width="90"
                 height="90"
                 alt="user-img"
                 class="rounded-circle img-thumbnail img-responsive">
        </div>
        <h5 class="my-3">
            <a href="<?php echo e(route('profile')); ?>"><?php echo e(auth()->user()->present()->nameOrEmail); ?></a>
        </h5>

        <ul class="list-inline mb-2">
            <li class="list-inline-item">
                <a href="<?php echo e(route('profile')); ?>" title="<?php echo app('translator')->get('My Profile'); ?>">
                    <i class="fas fa-cog"></i>
                </a>
            </li>

            <li class="list-inline-item">
                <a href="<?php echo e(route('auth.logout')); ?>" class="text-custom" title="<?php echo app('translator')->get('Logout'); ?>">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <?php $__currentLoopData = \Vanguard\Plugins\Vanguard::availablePlugins(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.sidebar.items', ['item' => $plugin->sidebar()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <li class="nav-item">
                <a class="nav-link" href="#ocr-dropdown" data-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-file"></i>
                    <span>OCR Labeling</span>
                </a>
            <?php $inShow = \Request::is('ocr') || \Request::is('ocr/invalid') || \Route::is('*.template') ?>
                <ul class="list-unstyled sub-menu collapse <?php if($inShow): ?> show <?php endif; ?>" id="ocr-dropdown">
                    <li class="nav-item">
                        <a  class="nav-link <?php if(\Request::is('ocr') || \Request::is('ocr/invalid')): ?> active <?php endif; ?>" 
                            href="<?php echo e(url('ocr')); ?>">
                            <span>OCR Tool</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link <?php if(\Route::is('*.template')): ?> active <?php endif; ?>" 
                            href="<?php echo e(route('index.template')); ?>">
                            <span>Templates</span>
                        </a>
                    </li>
                </ul>
            </li>  
            
            <?php if(Auth::user()->hasPermission('company.manage')): ?>
            <li class="nav-item">
                <a class="nav-link" href="#company-dropdown" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-building"></i>
                    <span>Company Manage</span>
                </a>
            <?php $inShow = \Request::is('company') || \Route::is('*.company') ?>
            <?php $ininShow = \Request::is('company') || \Route::is('slug.company') || \Route::is('add.company') ?>
                <ul class="list-unstyled sub-menu collapse <?php if($inShow): ?> show <?php endif; ?>" id="company-dropdown">
                    <li class="nav-item">
                        <a  class="nav-link <?php if($ininShow): ?> active <?php endif; ?>" 
                            href="<?php echo e(url('company')); ?>">
                            <span>Company</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link <?php if(\Route::is('ocr.key.company')): ?> active <?php endif; ?>" 
                            href="<?php echo e(route('ocr.key.company')); ?>">
                            <span>OCR Key</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="#api-reference" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>                   
                    <span>API Reference</span>
                </a>
            <?php $inShow = \Request::is('api') || \Route::is('api.*') ?>
                <ul class="list-unstyled sub-menu collapse <?php if($inShow): ?> show <?php endif; ?>" id="api-reference">
                    <li class="nav-item">
                        <a  class="nav-link <?php if(\Route::is('api.index')): ?> active <?php endif; ?>" 
                            href="<?php echo e(route('api.index')); ?>">
                            <span>API How To</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link <?php if(\Route::is('api.test')): ?> active <?php endif; ?>" 
                            href="<?php echo e(route('api.test')); ?>">
                            <span>API TEST</span>
                        </a>
                    </li>
                </ul>
            </li>
             
        </ul>
    </div>
</nav>

<?php /**PATH C:\xampp\htdocs\nvanguard\resources\views/partials/sidebar/main.blade.php ENDPATH**/ ?>