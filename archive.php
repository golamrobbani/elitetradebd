<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
                <div class="col-md-8">
                    <?php if ( have_posts() ) : ?>

                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'loop-templates/content', get_post_type() );

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
