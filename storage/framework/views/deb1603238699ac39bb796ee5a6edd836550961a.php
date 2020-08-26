<?php
    $banner_img = getImageUrl($city->banner);
    $page_title_bg = "style=background-image:url({$banner_img});";
?>

<?php $__env->startSection('main'); ?>
    <main class="site-main normal_view">
        <div class="maps-wrap">
            <div class="maps-button">
                <a href="#" id="mapview_close">
                    <?php if(setting('style_rtl')): ?>
                        <i class="la la-arrow-right la-24"></i>
                    <?php else: ?>
                        <i class="la la-arrow-left la-24"></i>
                    <?php endif; ?>
                    <?php echo e(__('Back to list')); ?>

                </a>
                <div class="field-select">
                    <select class="map_filter" id="category_id">
                        <option value=""><?php echo e(__('Show all')); ?></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(isSelected($cat->slug, $cat_slug)); ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <i class="la la-angle-down la-12"></i>
                </div>
                <input type="hidden" id="city_id" value="<?php echo e($city->id); ?>">
            </div>
            <div id="maps-view"></div>
        </div>

        <div class="page-title" <?php echo $page_title_bg; ?>>
            <div class="container">
                <div class="page-title__content">
                    <h4 class="page-title__capita"><?php echo e($city['country']['name']); ?></h4>
                    <h1 class="page-title__name"><?php echo e($city->name); ?></h1>
                    <p class="page-title__slogan"><?php echo e($city->intro); ?></p>
                </div>
            </div>
        </div><!-- .page-title -->
        <div class="intro">
            <div class="container">
                <h2 class="title"><?php echo e(__('Introducing')); ?></h2>
                <div class="intro__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="intro__text"><?php echo e($city->description); ?></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="intro__meta">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-item">
                                        <div class="intro__meta__item">
                                            <h3><?php echo e(__('Currency')); ?></h3>
                                            <p>
                                                <i class="la la-money-bill-wave la-24"></i>
                                                <span><?php echo e($city->currency); ?></span>
                                            </p>
                                        </div><!-- .intro__meta__item -->
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-item">
                                        <div class="intro__meta__item">
                                            <h3><?php echo e(__('Languages')); ?></h3>
                                            <p>
                                                <i class="la la-language la-24"></i>
                                                <span><?php echo e($city->language); ?></span>
                                            </p>
                                        </div><!-- .intro__meta__item -->
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-item">
                                        <div class="intro__meta__item">
                                            <h3><?php echo e(__('Best time to visit')); ?></h3>
                                            <p>
                                                <i class="la la-calendar la-24"></i>
                                                <span><?php echo e($city->best_time_to_visit); ?></span>
                                            </p>
                                        </div><!-- .intro__meta__item -->
                                    </div>
                                </div>
                            </div><!-- .intro__meta -->
                        </div>
                    </div>
                </div><!-- .intro__content -->
            </div>
        </div><!-- .intro -->
        <div class="city-content">
            <div class="city-content__tabtitle tabs">
                <div class="container">
                    <div class="city-content__tabtitle__tablist">
                        <ul>
                            <li class="<?php echo e(isActiveMenu('city_detail')); ?>"><a href="<?php echo e(route('city_detail', $city->slug)); ?>" title="<?php echo e($city->name); ?>"><?php echo e($city->name); ?></a></li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e(isActive($cat->slug, $cat_slug)); ?>"><a href="<?php echo e(route('city_category_detail', [$city->slug, $cat->slug])); ?>" title="<?php echo e($cat->name); ?>"><?php echo e($cat->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div><!-- .city-content__tabtitle__tablist -->
                    <a class="city-content__tabtitle__button btn btn-mapsview" title="<?php echo e(__('Maps view')); ?>" href="?view=map">
                        <i class="la la-map-marked-alt la-24"></i>
                        <?php echo e(__('Maps view')); ?>

                    </a><!-- .city-content__tabtitle__button -->
                </div>
            </div><!-- .city-content__tabtitle -->
            <div class="city-content__panels">
                <div class="container">

                    <?php if(isRoute('city_detail')): ?>
                        <div class="city-content__panel" id="inspire">
                            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="city-content__item">
                                    <h2 class="title title--more">
                                        <?php echo e($feature['feature_title'] ? $feature['feature_title'] : $feature['category_name']); ?>

                                        <a title="<?php echo e(__('See all')); ?>" href="<?php echo e(route('city_category_detail', [$city->slug, $feature['category_slug']])); ?>"><?php echo e(__('See all')); ?> (<?php echo e(count($feature['places'])); ?>)</a>
                                    </h2>
                                    <?php if(count($feature['places'])): ?>
                                        <div class="city-slider">
                                            <div class="city-slider__grid">
                                                <?php $__currentLoopData = $feature['places']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo $__env->make('frontend.common.place_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div><!-- .city-slider__grid -->
                                            <div class="city-slider__nav slick-nav">
                                                <div class="city-slider__prev slick-nav__prev">
                                                    <i class="la la-arrow-left la-24"></i>
                                                </div><!-- .city-slider__prev -->
                                                <div class="city-slider__next slick-nav__next">
                                                    <i class="la la-arrow-right la-24"></i>
                                                </div><!-- .city-slider__next -->
                                            </div><!-- .city-slider__nav -->
                                        </div><!-- .city-slider -->
                                    <?php else: ?>
                                        <?php echo e(__('No places')); ?>

                                    <?php endif; ?>
                                </div><!-- .city-content__item -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div><!-- .city-content__panel -->
                    <?php else: ?>
                        <div class="city-content__panel">
                            <div class="shop__meta">
                                <h2 class="title title--result"><?php echo e($places_by_category['category']['name']); ?> <span>(<?php echo e($places_by_category['places']->total()); ?> <?php echo e(__('results')); ?>)</span></h2>
                                <div class="shop__order site__order golo-nav-filter">
                                    <div class="golo-clear-filter">
                                        <i class="la la-times"></i>
                                        <span><?php echo e(__('Clear All')); ?></span>
                                    </div>
                                    <div class="shop__filter site__filter">
                                        <a title="Filter" class="golo-filter-toggle" href="#">
                                            <?php echo e(__('Filter')); ?>

                                            <i class="la la-angle-down"></i>
                                        </a>
                                    </div><!-- .shop__filter -->
                                </div><!-- .shop__order -->
                            </div><!-- .shop__meta -->

                            <div class="golo-menu-filter">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="entry-filter">
                                            <h4><?php echo e(__('Sort By')); ?></h4>
                                            <ul class="sort-by filter-control custom-scrollbar">
                                                <li><a href="#" data-sort="newest"><?php echo e(__('Newest')); ?></a></li>
                                                <li><a href="#" data-sort="rating"><?php echo e(__('Average rating')); ?></a></li>
                                                <li class="price-filter"><a href="#" data-sort="price_asc"><?php echo e(__('Price: Low to high')); ?></a></li>
                                                <li class="price-filter"><a href="#" data-sort="price_desc"><?php echo e(__('Price: High to low')); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="entry-filter">
                                            <h4><?php echo e(__('Price Filter')); ?></h4>
                                            <ul class="price filter-control custom-scrollbar">
                                                <li><a href="#" data-price="0"><?php echo e(__('Free')); ?></a></li>
                                                <li><a href="#" data-price="1"><?php echo e(__('Low: $')); ?></a></li>
                                                <li><a href="#" data-price="2"><?php echo e(__('Medium: $$')); ?></a></li>
                                                <li><a href="#" data-price="3"><?php echo e(__('High: $$$')); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="entry-filter">
                                            <h4><?php echo e(__('Types')); ?></h4>
                                            <ul class="type filter-control custom-scrollbar">
                                                <?php $__currentLoopData = $place_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <input type="checkbox" class="custom-checkbox input-control" id="type_<?php echo e($type->id); ?>" name="types" value="<?php echo e($type->id); ?>">
                                                        <label for="type_<?php echo e($type->id); ?>"><?php echo e($type->name); ?></label>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="entry-filter">
                                            <h4><?php echo e(__('Amenities')); ?></h4>
                                            <ul class="amenities filter-control custom-scrollbar">
                                                <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <input type="checkbox" class="custom-checkbox input-control" id="amenities_<?php echo e($item->id); ?>" name="amenities" value="<?php echo e($item->id); ?>">
                                                        <label for="amenities_<?php echo e($item->id); ?>"><?php echo e($item->name); ?></label>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="city_id" value="<?php echo e($city->id); ?>">
                                <input type="hidden" name="category_id" value="<?php echo e($places_by_category['category']['id']); ?>">
                            </div>

                            <div class="city-grid">
                                <div class="row" id="list_places">
                                    <?php if(count($places_by_category['places'])): ?>
                                        <?php $__currentLoopData = $places_by_category['places']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-xl-3 col-lg-4 col-6">
                                                <?php echo $__env->make('frontend.common.place_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="col-md-12 text-center">
                                            <?php echo e(__('No places')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="pagination">
                                    <?php echo e($places_by_category['places']->render('frontend.common.pagination')); ?>

                                </div><!-- .pagination -->
                            </div><!-- .city__grid -->
                        </div><!-- .city-content__panel -->
                    <?php endif; ?>

                </div>
            </div><!-- .city-content__panel -->
        </div><!-- .city-content -->

        <div class="other-city banner-dark">
            <div class="container">
                <h2 class="title title--while"><?php echo e(__('Explorer Other Cities')); ?></h2>
                <div class="other-city__content">
                    <div class="row">
                        <?php if(count($other_cities)): ?>
                            <?php $__currentLoopData = $other_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="cities__item hover__box">
                                        <div class="cities__thumb hover__box__thumb">
                                            <a href="<?php echo e(route('city_detail', $city->slug)); ?>" title="<?php echo e($city->name); ?>">
                                                <img src="<?php echo e(getImageUrl($city->thumb)); ?>" alt="newyork">
                                            </a>
                                        </div>
                                        <h4 class="cities__name"><?php echo e($city['country']['name']); ?></h4>
                                        <div class="cities__info">
                                            <h3 class="cities__capital"><?php echo e($city->name); ?></h3>
                                            <p class="cities__number"><?php echo e($city->places_count); ?> <?php echo e(__('places')); ?></p>
                                        </div>
                                    </div><!-- .cities__item -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="col-md-12">
                                <?php echo e(__('No cities')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div><!-- .other-city -->
    </main><!-- .site-main -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/page_city_detail.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\doclike\resources\views/frontend/city/city_detail.blade.php ENDPATH**/ ?>