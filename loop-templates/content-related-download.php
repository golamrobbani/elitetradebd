<div class="col-md-3 col-sm-6">
    <div class="single-related-product adjust_medium_post_height">
        <a href="<?php the_permalink(); ?>" class="product-image">
           <?php 
           the_post_thumbnail('product-medium-thumb');
           ?>
       </a>

       <div class="single-product-content-wrapper">
        <?php
        the_title( '<h2 class="product-title"><a href="' . get_the_permalink() . '">', '</a></h2>' );

        if ( function_exists( 'edd_price' ) ) { ?>
            <div class="product-price">
                <?php
                if ( edd_has_variable_prices( get_the_ID() ) ) {
                    echo edd_price_range( get_the_ID() );
                } else {
                    edd_price( get_the_ID() );
                }
                ?>
            </div>
            <?php } ?>

            <?php if ( function_exists( 'edd_price' ) ) { ?>
                <div class="product-buttons">
                    <a href="<?php the_permalink(); ?>" class="button"><i class="fa fa-list"></i>View Details</a>
                </div>
                <?php } ?>
            </div>

        </div>
    </div>
