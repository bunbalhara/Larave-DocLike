
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
                    <h1 class="title">N'attendez plus chez le Docteur</h1>
                    <p class="description">Comme un Dentiste disponible sur Paris ce matin</p>
                    <div class="pl-lg-5 pl-3">
                        <button class="btn btn-danger rounded">voir un docteur</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main class="w-100 d-flex flex-column align-items-center">
        <section class="section-category container">
            <div class="title">Comment ca marche</div>
            <div class="description">From its medieval orinins to the digital era. <strong>Doclike</strong></div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="{{asset('assets/images/category1.png')}}">
                        <div class="title">Demander</div>
                        <div class="description">Take a deep dive and try our list of over 40 unique generators</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="{{asset('assets/images/category2.png')}}">
                        <div class="title">Recevez</div>
                        <div class="description">Find placeholder images for your next design</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="category-item">
                        <img src="{{asset('assets/images/category3.png')}}">
                        <div class="title">Consulter</div>
                        <div class="description">Excepteur sint occaecat cupidatat non proident</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section container">
            <div class="title">Bon a savoir</div>
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
                               <div class="title">Qui parle votre</div>
                               <div class="sub-title">
                                   <span>Langue</span>
                                   <img src="{{asset('assets/images/flags/es.png')}}" alt="es">
                                   <img src="{{asset('assets/images/flags/fr.png')}}" alt="fr">
                               </div>
                               <div class="description">Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about enw work or exhibitions</div>
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
                                <div class="title">Voir un docteur,</div>
                                <div class="sub-title">
                                    <span>sans attendtre</span>
                                </div>
                                <div class="description">Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about enw work or exhibitions</div>
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
                                <div class="title">zhez vous, <span style="color: #00aa88">en </span></div>
                                <div class="sub-title">
                                    <span style="white-space: nowrap">ligne ou au cabinet</span>
                                </div>
                                <div class="description">Post directly to Instagram, email clients about what you're up to, or send newsletters with announcements about enw work or exhibitions</div>
                                <div class="pb-4"><a href="/" style="font-weight: bold; color: #00aa88">LEAD MORE</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-5">
            <div class="left-box">
                <div class="w-100 h-100 flex-column d-flex justify-content-center align-items-start" style="max-width: 500px">
                    <h1>Download App</h1>
                    <p>Download the app and go to travel the world</p>
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
