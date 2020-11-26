<?php
global $post;
$post_args     = array(
    'posts_per_page' => 20,
    'post_type' => 'download',
    'meta_key' => 'edd_product_view_count',
    'orderby' => 'meta_value_num',
    'order'=> 'DESC'
);
$posts = get_posts( $post_args );
?>


<div class="etbd-product-type">

<div class="etbd-product-type-header no-border">
    <h3 class="etbd-product-type-title">Popular Product</h3>
</div>

<div class="popular-product-slide">

    <div class="owl-popular-slide owl-carousel owl-theme">

            <?php
            foreach ( $posts as $post ) {
                setup_postdata( $post );
                $price=get_post_meta($post->ID, 'edd_price', true);
                $product_tags = get_the_terms( $post->ID, 'download_tag' );
                if ( ! empty( $product_tags ) && ! is_wp_error( $product_tags ) ) {
                    $tags = wp_list_pluck( $product_tags, 'name' );
                }
                ?> <div class="item">
                    <a class="product-card adjust_small_post_height" href="<?php echo get_the_permalink(); ?>">
                        <div class="product-card-img">
                            <?php
                            the_post_thumbnail('product-small-thumb');
                            ?>
                        </div>
                        <div class="product-card-content">
                            <div class="product-card-title"><?php echo get_the_title(); ?></div>
                            <div class="product-card-brand">
                                <?php
                                if (!empty($tags)) {
                                    $counter = 1;
                                    foreach ( $tags as $tag ) {
                                        echo $tag;
                                        echo ($counter < count($tags))? "," : "";
                                        $counter++;
                                    }
                                }
                                ?>
                            </div>
                            <div class="product-card-price">
                                <span class="price"><?php echo '৳'.$price ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } wp_reset_postdata();?>
        </div>


    <div class="owl-theme">
        <div class="owl-controls">
            <div class="custom-nav owl-nav"></div>
        </div>
    </div>

</div>
</div>