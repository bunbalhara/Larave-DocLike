<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php echo SEO::generate(); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/fonts/jost/stylesheet.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/line-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/bootstrap/css/bootstrap.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/slick/slick-theme.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/slick/slick.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/quilljs/css/quill.bubble.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/quilljs/css/quill.core.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/quilljs/css/quill.snow.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/chosen/chosen.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/photoswipe/photoswipe.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/photoswipe/default-skin/default-skin.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/lity/lity.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/gijgo/css/gijgo.min.css')); ?>"/>

    <?php if(setting('style_rtl')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/responsive-rtl.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom-rtl.css?v=1.0')); ?>"/>
    <?php else: ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/responsive.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css?v=1.0')); ?>"/>
    <?php endif; ?>

    <link rel="icon" sizes="16x16" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <script>
        var app_url = window.location.origin;
    </script>
    <?php echo $__env->yieldPushContent('style'); ?>
</head>

<body dir="<?php echo e(!setting('style_rtl') ?: 'rtl'); ?>">
<div id="wrapper">
    <header id="header" class="site-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-8">
                    <div class="site">
                        <div class="site__menu">
                            <a title="Menu Icon" href="#" class="site__menu__icon">
                                <i class="la la-bars la-24"></i>
                            </a>
                            <div class="popup-background"></div>
                            <div class="popup popup--left">
                                <a title="Close" href="#" class="popup__close">
                                    <i class="la la-times la-24"></i>
                                </a><!-- .popup__close -->
                                <div class="popup__content">
                                    <?php if(auth()->guard()->guest()): ?>
                                        <div class="popup__user popup__box open-form">
                                            <a title="Login" href="#" class="open-login"><?php echo e(__('Login')); ?></a>
                                            <a title="Sign Up" href="#" class="open-signup"><?php echo e(__('Sign Up')); ?></a>
                                        </div>
                                    <?php else: ?>
                                        <div class="account">
                                            <a href="#" title="<?php echo e(Auth::user()->name); ?>">
                                                <img src="<?php echo e(getUserAvatar(user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                                                <span>
                                                    <?php echo e(Auth::user()->name); ?>

                                                    <i class="la la-angle-down la-12"></i>
                                                </span>
                                            </a>
                                            <div class="account-sub">
                                                <ul>
                                                    <li class="<?php echo e(isActiveMenu('user_profile')); ?>"><a href="<?php echo e(route('user_profile')); ?>"><?php echo e(__('Profile')); ?></a></li>
                                                    <li class="<?php echo e(isActiveMenu('user_my_place')); ?>"><a href="<?php echo e(route('user_my_place')); ?>"><?php echo e(__('My Places')); ?></a></li>
                                                    <li class="<?php echo e(isActiveMenu('user_wishlist')); ?>"><a href="<?php echo e(route('user_wishlist')); ?>"><?php echo e(__('Wishlist')); ?></a></li>
                                                    <li>
                                                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(__('Logout')); ?></a>
                                                        <form class="d-none" id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .account -->
                                    <?php endif; ?>

                                    <div class="popup__destinations popup__box">
                                        <ul class="menu-arrow">
                                            <li>
                                                <a title="Destinations" href="#">France</a>
                                                <ul class="sub-menu">
                                                    <li><a href="javascript:void(0)" title="France">France</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- .popup__destinations -->
                                    <div class="popup__menu popup__box">
                                        <ul class="menu-arrow">
                                            <li>
                                                <a title="Home demo" href="<?php echo e(route('home')); ?>">Home</a>
                                                <ul class="sub-menu">
                                                    <li><a href="https://lara-business.getgolo.com">Business Listing</a></li>
                                                    <li><a href="https://lara-cityguide.getgolo.com">City Guide</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a title="Place detail" href="#">Place detail</a>
                                                <ul class="sub-menu">
                                                    <li><a href="<?php echo e(route('place_detail', 'boot-cafe')); ?>">Booking form</a></li>
                                                    <li><a href="<?php echo e(route('place_detail', 'le-meurice')); ?>">Affiliate Book Buttons</a></li>
                                                    <li><a href="<?php echo e(route('place_detail', 'musee-guimet')); ?>">Affiliate Banner Ads</a></li>
                                                    <li><a href="<?php echo e(route('place_detail', 'clamato')); ?>">Enquiry Form</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a title="Page" href="#">Page</a>
                                                <ul class="sub-menu">
                                                    <li><a href="https://lara.getgolo.com/post/about-us-10">About</a></li>
                                                    <li><a href="/page-404">404</a></li>
                                                    <li><a href="https://lara.getgolo.com/post/faqs-11">Faqs</a></li>
                                                    <li><a href="<?php echo e(route('page_landing', '03')); ?>">App Landing</a></li>
                                                    <li><a href="<?php echo e(route('page_landing', '01')); ?>">Construction</a></li>
                                                    <li><a href="<?php echo e(route('page_landing', '02')); ?>">Coming Soon</a></li>
                                                </ul>
                                            </li>
                                            <li><a title="Blog" href="<?php echo e(route('post_list_all')); ?>">Blog</a></li>
                                            <li><a title="Contacts" href="<?php echo e(route('page_contact')); ?>">Contact</a></li>
                                        </ul>
                                    </div><!-- .popup__menu -->
                                </div><!-- .popup__content -->
                                <div class="popup__button popup__box">
                                    <a class="btn" href="<?php echo e(route('place_addnew')); ?>">
                                        <i class="la la-plus la-24"></i>
                                        <span><?php echo e(__('Add place')); ?></span>
                                    </a>
                                </div><!-- .popup__button -->
                            </div><!-- .popup -->
                        </div><!-- .site__menu -->
                        <div class="site__brand">
                            <a title="Logo" href="<?php echo e(route('home')); ?>" class="site__brand__logo"><img src="<?php echo e(asset(setting('logo') ? 'uploads/' . setting('logo') : 'assets/images/assets/logo.png')); ?>" alt="logo"></a>
                        </div><!-- .site__brand -->

                        <?php if (! (isRoute('home'))): ?>
                            <?php if(setting('template', '01') == '01'): ?>
                                <div class="site__search golo-ajax-search">
                                    <a title="Close" href="#" class="search__close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                            <path fill="#5D5D5D" fill-rule="nonzero" d="M9.3 8.302l6.157-6.156a.706.706 0 1 0-.999-.999L8.302 7.304 2.146 1.148a.706.706 0 1 0-.999.999l6.157 6.156-6.156 6.155a.706.706 0 0 0 .998.999L8.302 9.3l6.156 6.156a.706.706 0 1 0 .998-.999L9.301 8.302z"/>
                                        </svg>
                                    </a><!-- .search__close -->
                                    <form action="<?php echo e(route('search')); ?>" class="site__search__form" method="GET">
                                        <div class="site__search__field">
                                    <span class="site__search__icon">
                                        <i class="la la-search la-24"></i>
                                    </span><!-- .site__search__icon -->
                                            <input class="site__search__input" type="text" name="keyword" placeholder="<?php echo e(__('Search places ...')); ?>" autocomplete="off">
                                            <div class="search-result"></div>
                                            <div class="golo-loading-effect"><span class="golo-loading"></span></div>
                                        </div><!-- .search__input -->
                                    </form><!-- .search__form -->
                                </div><!-- .site__search -->
                            <?php else: ?>
                                <div class="site__search layout-02">
                                    <a title="Close" href="#" class="search__close">
                                        <i class="la la-times"></i>
                                    </a><!-- .search__close -->
                                    <form action="<?php echo e(route('page_search_listing')); ?>" class="site-banner__search layout-02">
                                        <div class="field-input">
                                            <label for="input_search"><?php echo e(__('Find')); ?></label>
                                            <input class="site-banner__search__input open-suggestion" id="input_search" type="text" name="keyword" placeholder="Ex: Dentiste, kyné" autocomplete="off">
                                            <input type="hidden" name="category[]" id="category_id">
                                            <div class="search-suggestions category-suggestion">
                                                <ul>
                                                    <li><a href="#"><span><?php echo e(__('Loading...')); ?></span></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- .site-banner__search__input -->
                                        <div class="field-input">
                                            <label for="location_search"><?php echo e(__('Where')); ?></label>
                                            <input class="site-banner__search__input open-suggestion" id="location_search" type="text" name="city_name" placeholder="Your city" autocomplete="off">
                                            <input type="hidden" id="city_id">
                                            <div class="search-suggestions location-suggestion">
                                                <ul>
                                                    <li><a href="#"><span><?php echo e(__('Loading...')); ?></span></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- .site-banner__search__input -->
                                        <div class="field-submit">
                                            <button><i class="las la-search la-24-black"></i></button>
                                        </div>
                                    </form><!-- .site-banner__search -->
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div><!-- .site -->
                </div><!-- .col-md-6 -->


                <div class="col-md-6 col-4">
                    <div class="right-header align-right">
                        <div class="right-header__languages">
                            <a href="#">
                                <img src="<?php echo e(flagImageUrl(\Illuminate\Support\Facades\App::getLocale())); ?>">
                                <?php if(count($languages) > 1): ?>
                                    <i class="las la-angle-down la-12-black"></i>
                                <?php endif; ?>
                            </a>
                            <?php if(count($languages) > 1): ?>
                                <ul>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(\Illuminate\Support\Facades\App::getLocale() !== $language->code): ?>
                                            <li><a href="<?php echo e(route('change_language', $language->code)); ?>" title="<?php echo e($language->name); ?>"><img src="<?php echo e(flagImageUrl($language->code)); ?>"><?php echo e($language->name); ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="right-header__destinations">
                            <a title="Destinations" href="#">
                                <?php echo e(__('Country')); ?>

                                <i class="la la-angle-down la-12"></i>
                            </a>
                            <ul>
                                <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(route('city_detail', $city->slug)); ?>" title="<?php echo e($city->name); ?>"><?php echo e($city->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div><!-- .right-header__destinations -->
                        <?php if(auth()->guard()->guest()): ?>
                            <div class="right-header__login">
                                <a title="Login" class="open-login" href="#"><?php echo e(__('Login')); ?></a>
                            </div><!-- .right-header__login -->
                            <div class="right-header__signup">
                                <a title="Sign Up" class="open-signup" href="#"><?php echo e(__('Sign Up')); ?></a>
                            </div><!-- .right-header__signup -->
                            <div class="popup popup-form">
                                <a title="Close" href="#" class="popup__close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path fill="#5D5D5D" fill-rule="nonzero" d="M9.3 8.302l6.157-6.156a.706.706 0 1 0-.999-.999L8.302 7.304 2.146 1.148a.706.706 0 1 0-.999.999l6.157 6.156-6.156 6.155a.706.706 0 0 0 .998.999L8.302 9.3l6.156 6.156a.706.706 0 1 0 .998-.999L9.301 8.302z"/>
                                    </svg>
                                </a><!-- .popup__close -->
                                <ul class="choose-form">
                                    <li class="nav-login"><a title="Log In" href="#login"><?php echo e(__('Login')); ?></a></li>
                                    <li class="nav-signup"><a title="Sign Up" href="#register"><?php echo e(__('Sign Up')); ?></a></li>
                                </ul>
                                <div class="popup-content">

                                    <form class="form-log form-content" id="login" action="<?php echo e(route('login')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <p class="choose-more"><?php echo e(__('Continue with')); ?> <a title="Facebook" class="fb" href="<?php echo e(route('login_social', 'facebook')); ?>">Facebook</a> or <a title="Google" class="gg" href="<?php echo e(route('login_social', 'google')); ?>">Google</a></p>
                                        <p class="choose-or"><span><?php echo e(__('Or')); ?></span></p>

                                        <small class="form-text text-danger golo-d-none" id="login_error">error!</small>
                                        <div class="field-input">
                                            <input type="text" id="email" name="email" placeholder="Email Address" required>
                                        </div>
                                        <div class="field-input">
                                            <input type="password" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="choose-form mb-0">
                                            <a title="Forgot password" class="forgot_pass" href="#forgot_password"><?php echo e(__('Forgot password')); ?></a>
                                        </div>
                                        <button type="submit" class="gl-button btn button w-100" id="submit_login"><?php echo e(__('Login')); ?></button>
                                    </form>

                                    <form class="form-sign form-content" id="register" action="<?php echo e(route('register')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <p class="choose-more"><?php echo e(__('Continue with')); ?> <a title="Facebook" class="fb" href="<?php echo e(route('login_social', 'facebook')); ?>">Facebook</a> or <a title="Google" class="gg" href="<?php echo e(route('login_social', 'google')); ?>">Google</a></p>
                                        <p class="choose-or"><span><?php echo e(__('Or')); ?></span></p>

                                        <small class="form-text text-danger golo-d-none" id="register_error">error!</small>
                                        <div class="field-input">
                                            <input type="text" id="register_name" name="name" placeholder="Full Name" required>
                                        </div>
                                        <div class="field-input">
                                            <input type="email" id="register_email" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="field-input">
                                            <input type="password" id="register_password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="field-input">
                                            <input type="password" id="register_password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                        <div class="field-check">
                                            <label for="accept">
                                                <input type="checkbox" id="accept" checked required>
                                                Accept the <a title="Terms" href="#">Terms</a> and <a title="Privacy Policy" href="#">Privacy Policy</a>
                                                <span class="checkmark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6">
                                                    <path fill="#FFF" fill-rule="nonzero" d="M2.166 4.444L.768 3.047 0 3.815 1.844 5.66l.002-.002.337.337L7.389.788 6.605.005z"/>
                                                </svg>
                                            </span>
                                            </label>
                                        </div>
                                        <button type="submit" class="gl-button btn button w-100" id="submit_register"><?php echo e(__('Sign Up')); ?></button>
                                    </form>

                                    <form class="form-forgotpass form-content" id="forgot_password" action="<?php echo e(route('api_user_forgot_password')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <p class="choose-or"><span><?php echo e(__('Lost your password? Please enter your email address. You will receive a link to create a new password via email.')); ?></span></p>
                                        <small class="form-text text-danger golo-d-none" id="fp_error">error!</small>
                                        <small class="form-text text-success golo-d-none" id="fp_success">error!</small>
                                        <div class="field-input">
                                            <input type="text" id="email" name="email" placeholder="Email Address" required>
                                        </div>
                                        <button type="submit" class="gl-button btn button w-100" id="submit_forgot_password"><?php echo e(__('Forgot password')); ?></button>
                                    </form>

                                </div>
                            </div><!-- .popup-form -->
                        <?php else: ?>
                            <div class="account">
                                <a href="#" title="<?php echo e(Auth::user()->name); ?>">
                                    <img src="<?php echo e(getUserAvatar(user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                                    <span>
										<?php echo e(Auth::user()->name); ?>

										<i class="la la-angle-down la-12"></i>
									</span>
                                </a>
                                <div class="account-sub">
                                    <ul>
                                        <?php if(user()->isAdmin()): ?>
                                            <li class="<?php echo e(isActiveMenu('admin_dashboard')); ?>"><a href="<?php echo e(route('admin_dashboard')); ?>" target="_blank" rel="nofollow"><?php echo e(__('Dashboard')); ?></a></li>
                                        <?php endif; ?>
                                        <li class="<?php echo e(isActiveMenu('user_profile')); ?>"><a href="<?php echo e(route('user_profile')); ?>"><?php echo e(__('Profile')); ?></a></li>
                                        <li class="<?php echo e(isActiveMenu('user_my_place')); ?>"><a href="<?php echo e(route('user_my_place')); ?>"><?php echo e(__('My Places')); ?></a></li>
                                        <li class="<?php echo e(isActiveMenu('user_wishlist')); ?>"><a href="<?php echo e(route('user_wishlist')); ?>"><?php echo e(__('Wishlist')); ?></a></li>
                                        <li>
                                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(__('Logout')); ?></a>
                                            <form class="d-none" id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .account -->
                        <?php endif; ?>
                        <div class="right-header__search">
                            <a title="Search" href="#" class="search-open">
                                <i class="la la-search la-24"></i>
                            </a>
                        </div>
                        <div class="right-header__button btn">
                            <a title="Add place" href="<?php echo e(route('place_addnew')); ?>">
                                <i class="la la-plus la-24"></i>
                                <span><?php echo e(__('Add place')); ?></span>
                            </a>
                        </div><!-- .right-header__button -->
                    </div><!-- .right-header -->
                </div><!-- .col-md-6 -->
            </div><!-- .row -->


        </div><!-- .container-fluid -->
    </header><!-- .site-header -->

    <?php echo $__env->yieldContent('main'); ?>

    <footer id="footer" class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="footer__top__info">
                            <a title="Logo" href="#" class="footer__top__info__logo"><img src="<?php echo e(asset(setting('logo') ? 'uploads/' . setting('logo') : 'assets/images/assets/logo.png')); ?>" alt="logo"></a>
                            <p class="footer__top__info__desc"><?php echo e(__('Discover amazing things to do everywhere you go.')); ?></p>
                            <div class="footer__top__info__app">
                                <a title="App Store" href="#" class="banner-apps__download__iphone"><img src="<?php echo e(asset('assets/images/assets/app-store.png')); ?>" alt="App Store"></a>
                                <a title="Google Play" href="#" class="banner-apps__download__android"><img src="<?php echo e(asset('assets/images/assets/google-play.png')); ?>" alt="Google Play"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <aside class="footer__top__nav">
                            <h3><?php echo e(__('Company')); ?></h3>
                            <ul>
                                <li><a href="<?php echo e(url('post/about-us-10')); ?>"><?php echo e(__('About Us')); ?></a></li>
                                <li><a href="<?php echo e(route('post_list_all')); ?>"><?php echo e(__('Blog')); ?></a></li>
                                <li><a href=""><?php echo e(__('Faqs')); ?></a></li>
                                <li><a href="<?php echo e(route('page_contact')); ?>"><?php echo e(__('Contact')); ?></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-2">
                        <aside class="footer__top__nav">
                            <h3><?php echo e(__('Support')); ?></h3>
                            <ul>
                                <li><a href="#">Get in Touch</a></li>
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Live chat</a></li>
                                <li><a href="#">How it works</a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-3">
                        <aside class="footer__top__nav footer__top__nav--contact">
                            <h3><?php echo e(__('Contact Us')); ?></h3>
                            <p><?php echo e(__('Email: support@domain.com')); ?></p>
                            <p><?php echo e(__('Phone: 1 (00) 832 2342')); ?></p>
                            <ul>
                                <li>
                                    <a title="Facebook" href="#">
                                        <i class="la la-facebook la-24"></i>
                                    </a>
                                </li>
                                <li>
                                    <a title="Twitter" href="#">
                                        <i class="la la-twitter la-24"></i>
                                    </a>
                                </li>
                                <li>
                                    <a title="Youtube" href="#">
                                        <i class="la la-youtube la-24"></i>
                                    </a>
                                </li>
                                <li>
                                    <a title="Instagram" href="#">
                                        <i class="la la-instagram la-24"></i>
                                    </a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div><!-- .top-footer -->
            <div class="footer__bottom">
                <p class="footer__bottom__copyright"><?php echo e(now()->year); ?> &copy; <a href="<?php echo e(__('https://doclike.fr')); ?>" target="_blank"><?php echo e(__("Doclike powered by Hannapp's")); ?></a>. <?php echo e(__('All rights reserved.')); ?></p>
            </div><!-- .top-footer -->
        </div><!-- .container -->
    </footer><!-- site-footer -->
</div><!-- #wrapper -->
<!-- jQuery -->
<script src="<?php echo e(asset('assets/libs/jquery-1.12.4.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/popper/popper.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/slick/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/slick/jquery.zoom.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/isotope/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/photoswipe/photoswipe.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/photoswipe/photoswipe-ui-default.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/lity/lity.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/quilljs/js/quill.core.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/quilljs/js/quill.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/gijgo/js/gijgo.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/chosen/chosen.jquery.min.js')); ?>"></script>
<!-- orther script -->
<script src="<?php echo e(asset('assets/js/main.js?v=1.4')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.js?v=1.4')); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(setting('goolge_map_api_key', 'AIzaSyD-2mhVoLX7oIOgRQ-6bxlJt4TF5k0xhWc')); ?>&libraries=places&language=<?php echo e(\Illuminate\Support\Facades\App::getLocale()); ?>"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH E:\xampp\htdocs\doclike\resources\views/frontend/layouts/template.blade.php ENDPATH**/ ?>
