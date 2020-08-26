
@extends('frontend.layouts.main')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/home.css?'.time())}}"/>
@endsection

@section('main')
    <section class="section-banner">
        <div class="position-relative">
            <img class="banner-image" src="{{asset('assets/images/banner.png')}}" alt="banner"/>
            <div class="banner-content">
                <div>
                    <h1 class="title">{{__("Do not wait any longer at the Doctor")}}</h1>
                    <p class="description">{{__("Like a Dentist available in Paris this morning")}}</p>
                    <div class="pl-lg-5 pl-3">
                        <a class="btn btn-danger rounded" href="https://find.doclike.fr" style="background-color: #c44034">{{__("Find a doctor")}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main class="w-100 d-flex flex-column align-items-center">
        <section class="section-category container">
            <div class="title">{{__("How it works")}}</div>
            <div class="description">{{__("From its medieval origins to the digital era")}}. <strong>Doclike</strong></div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="{{asset('assets/images/category1.png')}}">
                        <div class="title">{{__("Request")}}</div>
                        <div class="description">{{__("Take a deep dive and try our list of over 40 unique generators")}}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="{{asset('assets/images/category2.png')}}">
                        <div class="title">{{__("Receive")}}</div>
                        <div class="description">{{__("Find placeholder images for your next design")}}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="{{asset('assets/images/category3.png')}}">
                        <div class="title">{{__("To consult")}}</div>
                        <div class="description">{{__("Excepteur sint occaecat cupidatat non proident")}}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section container">
            <div class="title">{{__("Good to know")}}</div>
            <div class="description">Lorem ipum si placeholder text commonly used in the graphic</div>
        </section>

        <section class="section w-100">
           <div class="container">
               <div class="row">
                   <div class="col-lg-6">
                       <div class="left-box">
                           <img src="{{asset('assets/images/home1.png')}}" alt="image"/>
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <div class="right-box">
                           <div class="w-100 d-flex flex-column align-items-start">
                               <div class="title">{{__("Who speaks your")}}</div>
                               <div class="sub-title">
                                   <span>{{__("Language")}}</span>
                                   <img src="{{asset('assets/images/flags/es.png')}}" alt="es">
                                   <img src="{{asset('assets/images/flags/fr.png')}}" alt="fr">
                               </div>
                               <div class="description">{{__("Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about new work or exhibitions")}}</div>
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
                                <div class="title">{{__("See a doctor")}},</div>
                                <div class="sub-title">
                                    <span>{{__("without waiting")}}</span>
                                </div>
                                <div class="description">{{__("Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about new work or exhibitions")}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-first order-lg-last">
                        <div class="left-box">
                            <img src="{{asset('assets/images/home2.png')}}" alt="image"/>
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
                            <img src="{{asset('assets/images/home3.png')}}" alt="image"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-box">
                            <div class="w-100 d-flex flex-column align-items-start">
                                <div class="title">{{__("zhez you")}}, <span style="color: #169bb9">en </span></div>
                                <div class="sub-title">
                                    <span style="white-space: nowrap">{{__("line or office")}}</span>
                                </div>
                                <div class="description">{{__("Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about new work or exhibitions")}}</div>
                                <div class="pb-4"><a href="/" style="font-weight: bold; color: #169bb9">{{__("LEAD MORE")}}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-5">
            <div class="left-box">
                <div class="w-100 h-100 flex-column d-flex justify-content-center align-items-start" style="max-width: 500px">
                    <h1>{{__("Download App")}}</h1>
                    <p style="max-width: 90%;  word-wrap: break-word;">{{__("Download the app and go to travel the world")}}</p>
                    <div class="d-flex justify-content-center align-items-center">
                        <div>
                            <a href="/">
                                <img src="{{asset('assets/images/app-store.png')}}" alt="app-store"/>
                            </a>
                        </div>
                        <div class="ml-2" >
                            <a href="/">
                                <img src="{{asset('assets/images/google-play.png')}}" alt="google-play" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="right-box">
                <div class="d-flex justify-content-center align-items-center h-100"  style="max-width: 500px">
                    <div><img src="{{asset('assets/images/home4.png')}}" /></div>
                </div>
            </div>
        </section>
    </main>

@stop
