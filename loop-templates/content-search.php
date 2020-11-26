<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chartdynamix
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <header class="entry-header">
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'large' ); ?>
                </a>
            </div>
        </header>
    <?php endif; ?>

    <div class="entry-content right-content">
        <?php
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        the_excerpt();
        ?>
    </div>

    <footer class="entry-footer">
        <?php
        themeplate_entry_footer();

        if ( ! is_singular() ) {
            echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html__( 'Read More', 'chartdynamix' ) . '<i class="fa fa-angle-right"></i> </a>';
        }
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
