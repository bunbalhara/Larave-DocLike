<?php $__env->startSection('main'); ?>
    <main id="main" class="site-main">
        <div class="page-title page-title--small align-left">
            <div class="container">
                <div class="page-title__content">
                    <h1 class="page-title__name"><?php echo e(__('404 Error')); ?></h1>
                    <p class="page-title__slogan"><?php echo e(__("Sorry, we couldn't find that page.")); ?></p>
                </div>
            </div>
        </div><!-- .page-title -->
        <div class="site-content">
            <div class="container">
                <div class="error-wrap">
                    <h2><?php echo e(__('OOPS!')); ?></h2>
                    <b><?php echo e(__("Sorry, we couldn't find that page.")); ?></b>
                    <p>
                        <?php echo e(__("We can't find the page or studio you're looking for.")); ?><br>
                        <?php echo e(__("Make sure you've typed in the URL correctly or try go")); ?> <a href="<?php echo e(route('home')); ?>"><?php echo e(__('Homepage')); ?></a>
                    </p>
                </div>
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\doclike\resources\views/errors/404.blade.php ENDPATH**/ ?>