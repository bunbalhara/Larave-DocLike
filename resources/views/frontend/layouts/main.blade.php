<!doctype html>
{{--{{dd(app()->getLocale())}}--}}
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    {!! SEO::generate() !!}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/jost/stylesheet.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/slick/slick-theme.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/quilljs/css/quill.bubble.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/quilljs/css/quill.core.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/quilljs/css/quill.snow.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/chosen/chosen.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/photoswipe/photoswipe.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/photoswipe/default-skin/default-skin.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/lity/lity.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/gijgo/css/gijgo.min.css')}}"/>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css?'.time())}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css?'.time())}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css?'.time())}}"/>

    <link rel="icon" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <script>
        var app_url = window.location.origin;
    </script>
    @stack('style')
    @yield('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
</head>

<body dir="{{!setting('style_rtl') ?: 'rtl'}}">
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
                                    @guest
                                        <div class="popup__user popup__box open-form">
                                            <a title="Login" href="#" class="open-login">{{__('Login')}}</a>
                                            <a title="Sign Up" href="#" class="open-signup">{{__('Sign Up')}}</a>
                                        </div>
                                    @else
                                        <div class="account">
                                            <a href="#" title="{{Auth::user()->name}}">
                                                <img src="{{getUserAvatar(user()->avatar)}}" alt="{{Auth::user()->name}}">
                                                <span>
                                                    {{Auth::user()->name}}
                                                    <i class="la la-angle-down la-12"></i>
                                                </span>
                                            </a>
                                            <div class="account-sub">
                                                <ul>
                                                    <li class="{{isActiveMenu('user_profile')}}"><a href="{{route('user_profile')}}">{{__('Profile')}}</a></li>
                                                    <li class="{{isActiveMenu('user_my_place')}}"><a href="{{route('user_my_place')}}">{{__('My Places')}}</a></li>
                                                    <li class="{{isActiveMenu('user_wishlist')}}"><a href="{{route('user_wishlist')}}">{{__('Wishlist')}}</a></li>
                                                    <li>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                                                        <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .account -->
                                    @endguest

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
                                                <a title="Home demo" href="/">{{__("Home")}}</a>
                                            </li>
                                            <li>
                                                <a title="Place detail" href="javascript:void(0)">{{__("How it works")}}</a>
                                            </li>
                                            <li>
                                                <a title="Page" href="javascript:void(0)">{{__("Pricing")}}</a>
                                            </li>
                                            <li><a title="Contacts" href="{{route('page_contact')}}">{{__("Contact")}}</a></li>
                                        </ul>
                                    </div><!-- .popup__menu -->
                                </div><!-- .popup__content -->
                                <div class="popup__button popup__box">
                                    <a class="btn" href="https://find.doclike.fr/" style="display: flex; justify-content: center; align-items: center">
                                        <i class="la la-plus la-22"></i>
                                        <span style="padding-top: 2px; padding-left: 5px">{{__('Find a doctor')}}</span>
                                    </a>
                                </div><!-- .popup__button -->
                            </div><!-- .popup -->
                        </div><!-- .site__menu -->

                        <div class="logo-container">
                            @include('frontend.include.logo')
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-4">
                    <div class="right-header align-right">
                        <div class="right-header__languages">
                            <a href="#">
                                <img src="{{flagImageUrl(app()->getLocale())}}">
                                @if(count($languages) > 1)
                                    <i class="las la-angle-down la-12-black"></i>
                                @endif
                            </a>
                            @if(count($languages) > 1)
                                <ul>
                                    @foreach($languages as $language)
                                        @if(app()->getLocale() !== $language->code)
                                            <li><a href="{{route('change_language', $language->code)}}" title="{{$language->name}}"><img src="{{flagImageUrl($language->code)}}">{{$language->name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="right-header__destinations">
                            <a title="Destinations" href="#">
                                Frnace
                                <i class="la la-angle-down la-12"></i>
                            </a>
                            <ul>
                                <li><a href="javascript:void(0)" title="France">France</a></li>
                            </ul>
                        </div><!-- .right-header__destinations -->
                        @guest
                            <div class="right-header__login">
                                <a title="Login" class="open-login" href="#">{{__('Login')}}</a>
                            </div><!-- .right-header__login -->
                            <div class="right-header__signup">
                                <a title="Sign Up" class="open-signup" href="#">{{__('Sign Up')}}</a>
                            </div><!-- .right-header__signup -->
                            <div class="popup popup-form">
                                <a title="Close" href="#" class="popup__close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path fill="#5D5D5D" fill-rule="nonzero" d="M9.3 8.302l6.157-6.156a.706.706 0 1 0-.999-.999L8.302 7.304 2.146 1.148a.706.706 0 1 0-.999.999l6.157 6.156-6.156 6.155a.706.706 0 0 0 .998.999L8.302 9.3l6.156 6.156a.706.706 0 1 0 .998-.999L9.301 8.302z"/>
                                    </svg>
                                </a><!-- .popup__close -->
                                <ul class="choose-form">
                                    <li class="nav-login"><a title="Log In" href="#login">{{__('Login')}}</a></li>
                                    <li class="nav-signup"><a title="Sign Up" href="#register">{{__('Sign Up')}}</a></li>
                                </ul>
                                <div class="popup-content">

                                    <form class="form-log form-content" id="login" action="{{route('login')}}" method="POST">
                                        @csrf
                                        <p class="choose-more">{{__('Continue with')}} <a title="Facebook" class="fb" href="{{route('login_social', 'facebook')}}">Facebook</a> or <a title="Google" class="gg" href="{{route('login_social', 'google')}}">Google</a></p>
                                        <p class="choose-or"><span>{{__('Or')}}</span></p>

                                        <small class="form-text text-danger golo-d-none" id="login_error">error!</small>
                                        <div class="field-input">
                                            <input type="text" id="email" name="email" placeholder="Email Address" required>
                                        </div>
                                        <div class="field-input">
                                            <input type="password" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="choose-form mb-0">
                                            <a title="Forgot password" class="forgot_pass" href="#forgot_password">{{__('Forgot password')}}</a>
                                        </div>
                                        <button type="submit" class="gl-button btn button w-100" id="submit_login">{{__('Login')}}</button>
                                    </form>

                                    <form class="form-sign form-content" id="register" action="{{route('register')}}" method="post">
                                        @csrf
                                        <p class="choose-more">{{__('Continue with')}} <a title="Facebook" class="fb" href="{{route('login_social', 'facebook')}}">Facebook</a> or <a title="Google" class="gg" href="{{route('login_social', 'google')}}">Google</a></p>
                                        <p class="choose-or"><span>{{__('Or')}}</span></p>

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
                                        <button type="submit" class="gl-button btn button w-100" id="submit_register">{{__('Sign Up')}}</button>
                                    </form>

                                    <form class="form-forgotpass form-content" id="forgot_password" action="{{route('api_user_forgot_password')}}" method="POST">
                                        @csrf
                                        <p class="choose-or"><span>{{__('Lost your password? Please enter your email address. You will receive a link to create a new password via email.')}}</span></p>
                                        <small class="form-text text-danger golo-d-none" id="fp_error">error!</small>
                                        <small class="form-text text-success golo-d-none" id="fp_success">error!</small>
                                        <div class="field-input">
                                            <input type="text" id="email" name="email" placeholder="Email Address" required>
                                        </div>
                                        <button type="submit" class="gl-button btn button w-100" id="submit_forgot_password">{{__('Forgot password')}}</button>
                                    </form>

                                </div>
                            </div><!-- .popup-form -->
                        @else
                            <div class="account">
                                <a href="#" title="{{Auth::user()->name}}">
                                    <img src="{{getUserAvatar(user()->avatar)}}" alt="{{Auth::user()->name}}">
                                    <span>
										{{Auth::user()->name}}
										<i class="la la-angle-down la-12"></i>
									</span>
                                </a>
                                <div class="account-sub">
                                    <ul>
                                        @if(user()->isAdmin())
                                            <li class="{{isActiveMenu('admin_dashboard')}}"><a href="{{route('admin_dashboard')}}" target="_blank" rel="nofollow">{{__('Dashboard')}}</a></li>
                                        @endif
                                        <li class="{{isActiveMenu('user_profile')}}"><a href="{{route('user_profile')}}">{{__('Profile')}}</a></li>
                                        <li class="{{isActiveMenu('user_my_place')}}"><a href="{{route('user_my_place')}}">{{__('My Places')}}</a></li>
                                        <li class="{{isActiveMenu('user_wishlist')}}"><a href="{{route('user_wishlist')}}">{{__('Wishlist')}}</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                                            <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('main')

    @include('frontend.include.footer')
</div><!-- #wrapper -->
<!-- jQuery -->
<script src="{{asset('assets/libs/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/libs/popper/popper.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/libs/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/libs/slick/jquery.zoom.min.js')}}"></script>
<script src="{{asset('assets/libs/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/libs/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('assets/libs/lity/lity.min.js')}}"></script>
<script src="{{asset('assets/libs/quilljs/js/quill.core.js')}}"></script>
<script src="{{asset('assets/libs/quilljs/js/quill.js')}}"></script>
<script src="{{asset('assets/libs/gijgo/js/gijgo.min.js')}}"></script>
<script src="{{asset('assets/libs/chosen/chosen.jquery.min.js')}}"></script>
<!-- orther script -->
<script src="{{asset('assets/js/main.js?v=1.4')}}"></script>
<script src="{{asset('assets/js/custom.js?v=1.4')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{setting('goolge_map_api_key', 'AIzaSyAcJ5DVBnqF-t-q2jeyX-2FE-TDf42rE5s')}}&libraries=places&language={{\Illuminate\Support\Facades\App::getLocale()}}"></script>

@stack('scripts')

</body>
</html>
