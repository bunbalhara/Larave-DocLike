@extends('frontend.layouts.template_02')
@section('main')
    <main id="main" class="site-main">
        <div class="archive-city">
            <div class="col-left">
                <div class="archive-filter">
                    <form action="#" class="filterForm" id="filterForm">
                        <div class="filter-head">
                            <h2>{{__('Filter')}}</h2>
                            {{--<a href="#" class="clear-filter"><i class="fal fa-sync"></i>Clear all</a>--}}
                            <a href="#" class="close-filter"><i class="las la-times"></i></a>
                        </div>
                        <div class="filter-box">
                            <h3>Cities</h3>
                            <div class="filter-list">
                                <div class="filter-group">
                                    @foreach($cities as $city)
                                        <div class="field-check">
                                            <label class="bc_filter" for="city_{{$city->id}}">
                                                <input type="checkbox" id="city_{{$city->id}}" name="city[]" value="{{$city->id}}" {{isChecked($city->id, $filter_city)}}>
                                                {{$city->name}}
                                                <span class="checkmark"><i class="la la-check"></i></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="more open-more" data-close="Close" data-more="More">More</a>
                            </div>
                        </div>
                        <div class="filter-box">
                            <h3>Categories</h3>
                            <div class="filter-list">
                                <div class="filter-group">
                                    @foreach($categories as $cat)
                                        <div class="field-check">
                                            <label class="bc_filter" for="cat_{{$cat->id}}">
                                                <input type="checkbox" id="cat_{{$cat->id}}" name="category[]" value="{{$cat->id}}" {{isChecked($cat->id, $filter_category)}}>
                                                {{$cat->name}}
                                                <span class="checkmark"><i class="la la-check"></i></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="more open-more" data-close="Close" data-more="More">{{__('More')}}</a>
                            </div>
                        </div>
                        <div class="filter-box">
                            <h3>{{__('Place Type')}}</h3>
                            <div class="filter-list">
                                <div class="filter-group">
                                    @foreach($place_types as $place_type)
                                        <div class="field-check">
                                            <label class="bc_filter" for="place_type_{{$place_type->id}}">
                                                <input type="checkbox" id="place_type_{{$place_type->id}}" name="place_type[]" value="{{$place_type->id}}" {{isChecked($place_type->id, $filter_place_type)}}>
                                                {{$place_type->name}}
                                                <span class="checkmark"><i class="la la-check"></i></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="more open-more" data-close="Close" data-more="More">{{__('More')}}</a>
                            </div>
                        </div>
                        <div class="filter-box">
                            <h3>{{__('Amenities')}}</h3>
                            <div class="filter-list">
                                <div class="filter-group">
                                    @foreach($amenities as $item)
                                        <div class="field-check">
                                            <label class="bc_filter" for="amenities_{{$item->id}}">
                                                <input type="checkbox" id="amenities_{{$item->id}}" name="amenities[]" value="{{$item->id}}" {{isChecked($item->id, $filter_amenities)}}>
                                                {{$item->name}}
                                                <span class="checkmark"><i class="la la-check"></i></span>
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                                <a href="#" class="more open-more" data-close="Close" data-more="More">More</a>
                            </div>
                        </div>
                        <div class="form-button align-center">
                            <input type="hidden" name="keyword" value="{{$keyword}}">
                            <a href="#" class="btn">{{__('Apply')}}</a>
                        </div>
                    </form>
                </div><!-- .archive-fillter -->

                <div class="main-primary">
                    <div class="filter-mobile">
                        <ul>
                            <li><a class="mb-filter mb-open" href="#filterForm">{{__('Filter')}}</a></li>
                        </ul>
                        <div class="mb-maps"><a class="mb-maps" href="#"><i class="las la-map-marked-alt"></i></a></div>
                    </div>
                    <div class="top-area top-area-filter">
                        <span class="result-count"><span class="count">{{$places->total()}}</span> {{__('results')}}</span>
                        {{--<a href="#" class="clear">Clear filter</a>--}}
                        <div class="select-box">
                        </div><!-- .select-box -->
                        <div class="show-map">
                            <span>{{__('Maps')}}</span>
                            <a href="#" class="icon-toggle"></a>
                        </div><!-- .show-map -->
                    </div>

                    <div class="area-places">
                        @if($places->total())
                            @foreach($places as $place)
                                <div class="place-item place-hover layout-02" data-maps="">
                                    <div class="place-inner">
                                        <div class="place-thumb">
                                            <a class="entry-thumb" href="{{route('place_detail', $place->slug)}}"><img src="{{getImageUrl($place->thumb)}}" alt=""></a>
                                            <a href="#" class="golo-add-to-wishlist btn-add-to-wishlist @if($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif" data-id="{{$place->id}}">
											<span class="icon-heart">
												<i class="la la-bookmark large"></i>
											</span>
                                            </a>
                                            <a class="entry-category rosy-pink" href="{{route('page_search_listing', ['category[]' => $place['categories'][0]['id']])}}" style="background-color:{{$place['categories'][0]['color_code']}};">
                                                <img src="{{getImageUrl($place['categories'][0]['icon_map_marker'])}}" alt="{{$place['categories'][0]['name']}}">
                                                <span>{{$place['categories'][0]['name']}}</span>
                                            </a>
                                        </div>
                                        <div class="entry-detail">
                                            <div class="entry-head">
                                                <div class="place-type list-item">
                                                    @foreach($place['place_types'] as $type)
                                                        <span>{{$type->name}}</span>
                                                    @endforeach
                                                </div>
                                                <div class="place-city">
                                                    <a href="{{route('page_search_listing', ['city[]' => $place['city']['id']])}}">{{$place['city']['name']}}</a>
                                                </div>
                                            </div>
                                            <h3 class="place-title"><a href="{{route('place_detail', $place->slug)}}">{{$place->name}}</a></h3>
                                            <div class="entry-bottom">
                                                <div class="place-preview">
                                                    <div class="place-rating">
                                                        @if($place->reviews_count)
                                                            <span>{{number_format($place->avgReview, 1)}}</span>
                                                            <i class="la la-star"></i>
                                                        @endif
                                                    </div>
                                                    <span class="count-reviews">({{$place->reviews_count}} {{__('reviews')}})</span>
                                                </div>
                                                <div class="place-price">
                                                    <span>{{PRICE_RANGE[$place['price_range']]}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-3">
                                <p>{{__('Nothing found!')}}</p>
                                <p>{{__("We're sorry but we do not have any listings matching your search, try to change you search settings")}}</p>
                            </div>
                        @endif
                    </div>
                    <div class="pagination">
                        {{$places->render('frontend.common.pagination')}}
                    </div>
                </div><!-- .main-primary -->
            </div><!-- .col-left -->

            <div class="col-right">
                <div class="filter-head">
                    <h2>{{__('Maps')}}</h2>
                    <a href="#" class="close-maps">{{__('Close')}}</a>
                </div>
                <div class="entry-map">
                    <div id="place-map-filter"></div>
                </div>
            </div><!-- .col-right -->
        </div><!-- .archive-city -->
    </main><!-- .site-main -->
@stop

@push('scripts')
    <script src="{{asset('assets/js/page_business_category.js')}}"></script>
    <script>
        var GL_BC = GL_BC || {};

(function ($) {
    "use strict";

    GL_BC = {
        init: function () {
            GL_BC.clickFilter();
            GL_BC.categoryMap();
            console.log("category.....");
        },

        clickFilter: function () {
            $(document).on('click', '.bc_filter', function (e) {
                $('#filterForm').submit();
            });
        },

        categoryMap: function () {
            var golo_create_markers = function (data, map) {
                var infowindow = new google.maps.InfoWindow();

                $.each(data, function (i, value) {

                    let html_review = '';
                    let html_category = '';

                    if (value.avg_review.length) {
                        html_review = `
                            ${value.avg_review[0]['aggregate']} <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/></svg>
                            `;
                    }

                    if (value.categories) {
                        for (var j = 0; j < value.categories.length; j++) {
                            html_category += `<a style="color: #666;"> ${value.categories[j]['name']}</a>`;
                        }
                    }

                    var html_infowindow = `
                        <div id='infowindow'>
                            <div class="places-item" data-title="${value.name}" data-lat="-33.796864" data-lng="150.620614" data-index="${i}">
                                <a href="/place/${value.slug}"><img src="/uploads/${value.thumb}" alt=""></a>
                                <div class="places-item__info">
                                    <span class="places-item__category">${html_category}</span>
                                    <a href="/place/${value.slug}"><h3>${value.name}</h3></a>
                                    <div class="places-item__meta">
                                        <div class="places-item__reviews">
                                            <span class="places-item__number">
                                                ${html_review}
                                                <span class="places-item__count">(${value.reviews_count} reviews)</span>
                                            </span>
                                        </div>
                                        <div class="places-item__currency">${PRICE_RANGE[value.price_range]}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                    let marker_options = {
                        position: {lat: parseFloat(value.lat), lng: parseFloat(value.lng)},
                        map: map,
                        draggable: false,
                        animation: google.maps.Animation.DROP
                    };
                    if (value.categories[0].icon_map_marker) {
                        marker_options.icon = {
                            url: `/assets/images/icon-mapker.svg`
                        }
                    }
                    let marker = new google.maps.Marker(marker_options);
                    marker.addListener('click', function () {
                        infowindow.setContent(html_infowindow);
                        infowindow.open(map, this);
                    });
                }); // End each data
            };

            // call api get places
            let ajax_url = window.location.href;
            (ajax_url.indexOf('?') > -1) ? ajax_url += '&ajax=1' : ajax_url += '?ajax=1';

            $.ajax({
                dataType: 'json',
                url: ajax_url,
                beforeSend: function () {
                    console.log("before call api get places map");
                },
                success: function (response) {
                    let data = response.data;

                    console.log("data: ", data);

                    var golo_map_style_silver = [
                        {
                            "featureType": "landscape",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "stylers": [
                                {
                                    "hue": "#00aaff"
                                },
                                {
                                    "saturation": -100
                                },
                                {
                                    "gamma": 2.15
                                },
                                {
                                    "lightness": 12
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "lightness": 24
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "lightness": 57
                                }
                            ]
                        }
                    ];
                    var golo_map_option = {
                        scrollwheel: false,
                        scroll: {x: $(window).scrollLeft(), y: $(window).scrollTop()},
                        zoom: 12,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: false,
                        fullscreenControl: true,
                        streetViewControl: true,
                        disableDefaultUI: false,
                        styles: golo_map_style_silver,
                        zoomControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        },
                        streetViewControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        },
                        fullscreenControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        }
                    };

                    if (data.city) {
                        golo_map_option.center = {lat: parseFloat(data.city.lat), lng: parseFloat(data.city.lng)};
                    } else {
                        console.log("khong co city: ", data.city);
                        golo_map_option.center = new google.maps.LatLng(0, 0);
                        golo_map_option.zoom = 2;
                        golo_map_option.minZoom = 0;
                    }

                    var map = new google.maps.Map(document.getElementById('place-map-filter'), golo_map_option);
                    golo_create_markers(data.places, map);

                },
            });


        }


    }

    GL_BC.init();
})(jQuery);

    </script>
@endpush
