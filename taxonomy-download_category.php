<?php
get_header(); ?>

<section class="breadcrumb-area text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-heading">
                    <?php
                    the_archive_title( '<h1 class="breadcrumb-title">', '</h1>' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-listing-area clearfix">
                    <?php
                    // $current_page = get_query_var( 'paged' );
                    //$per_page     = get_option( 'posts_per_page' );
                    // $offset       = $current_page > 0 ? $per_page * ( $current_page - 1 ) : 0;

                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $categories = get_queried_object();
                    $category   = $categories->slug;

                    $product_args = array(
                        'post_type'      => 'download',
                        'posts_per_page' => 10,
                        'paged'          => $paged,
                        'tax_query' => array(
                            array (
                                'taxonomy' => 'download_category',
                                'field' => 'slug',
                                'terms' => $category,
                            )
                        ), 
                    );
                    $products     = new WP_Query( $product_args );
                    ?>
                    <?php if ( $products->have_posts() ) : $i = 1; ?>
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                            <div class="product-list<?php if ( $i % 4 == 0 ) { echo ' last'; } ?>">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="product-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'product-image' ); ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <?php
                                        the_title( '<h2 class="product-title"><a href="' . get_the_permalink() . '">', '</a></h2>' );

                                        if ( function_exists( 'edd_price' ) ) { ?>
                                            <div class="product-price">
                                                <?php
                                                if ( edd_has_variable_prices( get_the_ID() ) ) {
                                                    // if the download has variable prices, show the first one as a starting price
                                                    echo 'Starting at: ';
                                                    edd_price( get_the_ID() );
                                                } else {
                                                    edd_price( get_the_ID() );
                                                }
                                                ?>
                                            </div>
                                            <?php } ?>

                                            <div class="product-excerpt">
                                                <?php the_excerpt(); ?>
                                            </div>

                                            <?php
                                            if ( function_exists( 'edd_price' ) ) { ?>
                                                <div class="product-buttons">
                                                    <!--                                                --><?php //if ( ! edd_has_variable_prices( get_the_ID() ) ) { ?>
                                                        <!--                                                    --><?php //echo edd_get_purchase_link( get_the_ID(), 'Add to Cart', 'button' ); ?>
                                                        <!--                                                --><?php //} ?>
                                                        <a href="<?php the_permalink(); ?>" class="button"><i class="fa fa-list"></i>View Details</a>
                                                    </div>
                                                    <?php } ?>

                                                </div>
                                            </div>

                                        </div>
                                        <?php $i += 1; ?>
                                    <?php endwhile; ?>

                                    <div class="pagination">
                                        <?php
                                        pagination_bar($products);
                                        ?>
                                    </div>
                                    <?php wp_reset_postdata();?>
                                    <?php else : ?>

                                        <h2 class="center">Not Found</h2>
                                        <p class="center">Sorry, but you are looking for something that isn't here.</p>
                                        <?php get_search_form(); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php get_footer(); ?>