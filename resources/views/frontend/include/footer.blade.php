<footer id="footer" class="footer">
    <div class="container">
        <div class="footer__top">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer__top__info">
                        @include('frontend.include.logo')
                        <p class="footer__top__info__desc">{{__('Discover amazing things to do everywhere you go.')}}</p>
                        <div class="footer__top__info__app">
                            <a title="App Store" href="#" class="banner-apps__download__iphone"><img src="{{asset('assets/images/assets/app-store.png')}}" alt="App Store"></a>
                            <a title="Google Play" href="#" class="banner-apps__download__android"><img src="{{asset('assets/images/assets/google-play.png')}}" alt="Google Play"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <aside class="footer__top__nav">
                        <h3>{{__('Company')}}</h3>
                        <ul>
                            <li><a href="{{url('post/about-us-10')}}">{{__('About Us')}}</a></li>
                            <li><a href="{{route('post_list_all')}}">{{__('Blog')}}</a></li>
                            <li><a href="">{{__('Faqs')}}</a></li>
                            <li><a href="{{route('page_contact')}}">{{__('Contact')}}</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-2">
                    <aside class="footer__top__nav">
                        <h3>{{__('Support')}}</h3>
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
                        <h3>{{__('Contact Us')}}</h3>
                        <p>{{__('Email: support@doclike.fr')}}</p>
                        <p>{{__('Phone: 1 (00) 832 2342')}}</p>
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
            <p class="footer__bottom__copyright">{{now()->year}} &copy; <a href="{{__('https://doclike.fr')}}" target="_blank">{{__("Doclike powered by Hannapp's")}}</a>. {{__('All rights reserved.')}}</p>
        </div><!-- .top-footer -->
    </div><!-- .container -->
</footer>
