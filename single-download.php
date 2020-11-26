<?php
get_header();
global $post;
?>
<section class="breadcrumb-area text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-heading">
                    <?php
                    the_title( '<h1 class="breadcrumb-title">', '</h1>' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'loop-templates/content', get_post_type() );

            endwhile;
            ?>
        </div>




        <div class="row">
            <div class="col-md-12">
                <div class="row social-share-box-area">
                    <a href="<?php echo wdp_get_share_link( $post->ID, 'facebook' ); ?>" target="_blank" class="social-share-box">
                        <i class="fa fa-facebook"></i>
                        <p><?php echo esc_html__( 'Share On Facebook', 'themeplate' ) ?></p>
                    </a>
                    
                  

                    <a href="<?php echo wdp_get_share_link( $post->ID, 'twitter' ); ?>" target="_blank" class="social-share-box">
                        <i class="fa fa-twitter"></i>
                        <p><?php echo esc_html__( 'Tweet This Product', 'themeplate' ) ?></p>
                    </a>

                    <a href="" target="_blank" class="social-share-box">
                        <i class="fa fa-pinterest"></i>
                        <p><?php echo esc_html__( 'Pin This Product', 'themeplate' ) ?></p>
                    </a>

                    <a href="<?php echo wdp_get_share_link( $post->ID, 'email' ); ?>" class="social-share-box">
                        <i class="fa fa-envelope"></i>
                        <p><?php echo esc_html__( 'Mail This Product', 'themeplate' ) ?></p>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="related-products-area clearfix">
                <div class="col-md-12">
                    <h5 class="related-products-heading"><?php echo esc_html__( 'Related products', 'themeplate' ) ?></h5>
                </div>
                <?php get_template_part( 'loop-templates/related-download-loop' ); ?>
            </div>
        </div>

    </div>
</section>

<?php
ShortCode::edd_popular_product_view( get_the_ID() );
get_footer();
