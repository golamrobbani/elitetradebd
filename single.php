<?php
/**
 * The template for displaying all single posts.
 *
 * @package themeplate
 */

get_header(); ?>
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
                <div class="col-md-8">
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'loop-templates/content', get_post_type() );

                        the_post_navigation();

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile;
                    ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>

<?php
ShortCode::cd_set_post_views( get_the_ID() );
get_footer();
