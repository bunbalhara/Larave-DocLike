<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/home.css?'.time())); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <section class="section-banner">
        <div class="position-relative">
            <img class="banner-image" src="<?php echo e(asset('assets/images/banner.png')); ?>" alt="banner"/>
            <div class="banner-content">
                <div>
                    <h1 class="title"><?php echo e(__("Do not wait any longer at the Doctor")); ?></h1>
                    <p class="description"><?php echo e(__("Like a Dentist available in Paris this morning")); ?></p>
                    <div class="pl-lg-5 pl-3">
                        <a class="btn btn-danger rounded" href="#" style="background-color: #c44034"><?php echo e(__("Find a doctor")); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main class="w-100 d-flex flex-column align-items-center">
        <section class="section-category container">
            <div class="title"><?php echo e(__("How it works")); ?></div>
            <div class="description"><?php echo e(__("From its medieval origins to the digital era")); ?>. <strong>Doclike</strong></div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="<?php echo e(asset('assets/images/category1.png')); ?>">
                        <div class="title"><?php echo e(__("Request")); ?></div>
                        <div class="description"><?php echo e(__("Take a deep dive and try our list of over 40 unique generators")); ?></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="<?php echo e(asset('assets/images/category2.png')); ?>">
                        <div class="title"><?php echo e(__("Receive")); ?></div>
                        <div class="description"><?php echo e(__("Find placeholder images for your next design")); ?></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="<?php echo e(asset('assets/images/category3.png')); ?>">
                        <div class="title"><?php echo e(__("To consult")); ?></div>
                        <div class="description"><?php echo e(__("Excepteur sint occaecat cupidatat non proident")); ?></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section container">
            <div class="title"><?php echo e(__("Good to know")); ?></div>
            <div class="description">Lorem ipum si placeholder text commonly used in the graphic</div>
        </section>

        <section class="section w-100">
           <div class="container">
               <div class="row">
                   <div class="col-lg-6">
                       <div class="left-box">
                           <img src="<?php echo e(asset('assets/images/home1.png')); ?>" alt="image"/>
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <div class="right-box">
                           <div class="w-100 d-flex flex-column align-items-start">
                               <div class="title"><?php echo e(__("Who speaks your")); ?></div>
                               <div class="sub-title">
                                   <span><?php echo e(__("Language")); ?></span>
                                   <img src="<?php echo e(asset('assets/images/flags/es.png')); ?>" alt="es">
                                   <img src="<?php echo e(asset('assets/images/flags/fr.png')); ?>" alt="fr">
                               </div>
                               <div class="description"><?php echo e(__("Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about new work or exhibitions")); ?></div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </section>

        <section class="section w-100 mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-last order-lg-first">
                        <div class="right-box">
                            <div class="w-100 d-flex flex-column align-items-start">
                                <div class="title"><?php echo e(__("See a doctor")); ?>,</div>
                                <div class="sub-title">
                                    <span><?php echo e(__("without waiting")); ?></span>
                                </div>
                                <div class="description"><?php echo e(__("Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about new work or exhibitions")); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-first order-lg-last">
                        <div class="left-box">
                            <img src="<?php echo e(asset('assets/images/home2.png')); ?>" alt="image"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section w-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="left-box">
                            <img src="<?php echo e(asset('assets/images/home3.png')); ?>" alt="image"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-box">
                            <div class="w-100 d-flex flex-column align-items-start">
                                <div class="title"><?php echo e(__("zhez you")); ?>, <span style="color: #169bb9">en </span></div>
                                <div class="sub-title">
                                    <span style="white-space: nowrap"><?php echo e(__("line or office")); ?></span>
                                </div>
                                <div class="description"><?php echo e(__("Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about new work or exhibitions")); ?></div>
                                <div class="pb-4"><a href="/" style="font-weight: bold; color: #169bb9"><?php echo e(__("LEAD MORE")); ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-5">
            <div class="left-box">
                <div class="w-100 h-100 flex-column d-flex justify-content-center align-items-start" style="max-width: 500px">
                    <h1><?php echo e(__("Download App")); ?></h1>
                    <p style="max-width: 90%;  word-wrap: break-word;"><?php echo e(__("Download the app and go to travel the world")); ?></p>
                    <div class="d-flex justify-content-center align-items-center">
                        <div>
                            <a href="/">
                                <img src="<?php echo e(asset('assets/images/app-store.png')); ?>" alt="app-store"/>
                            </a>
                        </div>
                        <div class="ml-2" >
                            <a href="/">
                                <img src="<?php echo e(asset('assets/images/google-play.png')); ?>" alt="google-play" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="right-box">
                <div class="d-flex justify-content-center align-items-center h-100"  style="max-width: 500px">
                    <div><img src="<?php echo e(asset('assets/images/home4.png')); ?>" /></div>
                </div>
            </div>
        </section>
    </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\doclike\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>