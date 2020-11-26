<?php
/**
 * The template for displaying search results pages.
 *
 * @package themeplate
 */

get_header(); ?>
    <section class="breadcrumb-area text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-heading">
                        <h1 class="breadcrumb-title">
                            <?php
                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'themeplate' ), '<span>' . get_search_query() . '</span>' );
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php if ( have_posts() ) : 

                        while ( have_posts() ) : the_post();

                            get_template_part( 'loop-templates/content', 'search' );

                        endwhile;

                        the_posts_navigation();

                    else :

                        get_template_part( 'loop-templates/content', 'none' );

                    endif;
                    ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
