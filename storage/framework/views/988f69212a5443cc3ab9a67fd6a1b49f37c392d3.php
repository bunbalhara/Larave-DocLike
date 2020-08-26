<div class="places-item hover__box">
    <div class="places-item__thumb hover__box__thumb">
        <a title="<?php echo e($place->name); ?>" href="<?php echo e(route('place_detail', $place->slug)); ?>"><img src="<?php echo e(getImageUrl($place->thumb)); ?>" alt="<?php echo e($place->name); ?>"></a>
    </div>
    <a href="#" class="place-item__addwishlist <?php if($place->wish_list_count): ?> remove_wishlist active <?php else: ?> <?php if(auth()->guard()->guest()): ?> open-login <?php else: ?> add_wishlist <?php endif; ?> <?php endif; ?>" data-id="<?php echo e($place->id); ?>" title="Add Wishlist">
        <i class="la la-bookmark la-24"></i>
    </a>
    <div class="places-item__info">
        <div class="places-item__category">
            <?php $__currentLoopData = $place['place_types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#" title="<?php echo e($type->name); ?>"><?php echo e($type->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h3><a href="<?php echo e(route('place_detail', $place->slug)); ?>" title="<?php echo e($place->name); ?>"><?php echo e($place->name); ?></a></h3>
        <div class="places-item__meta">
            <div class="places-item__reviews">
                <span class="places-item__number">
                    <?php if($place->reviews_count): ?>
                        <?php echo e(number_format($place->avgReview, 1)); ?>

                        <i class="la la-star"></i>
                    <?php endif; ?>
                    <span class="places-item__count">(<?php echo e($place->reviews_count); ?> <?php echo e(__('reviews')); ?>)</span>
                </span>
            </div>
            <div class="places-item__currency">
                <?php echo e(PRICE_RANGE[$place['price_range']]); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\xampp\htdocs\doclike\resources\views/frontend/common/place_item.blade.php ENDPATH**/ ?>