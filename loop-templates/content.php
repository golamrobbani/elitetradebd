<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package themeplate
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( ! is_singular() ) : ?>

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

    <?php else : ?>

        <?php if ( has_post_thumbnail() ) : ?>
            <header class="entry-header">
                <div class="post-thumbnail">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            </header>
        <?php endif; ?>

        <div class="entry-content">
            <?php
            the_content( sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'themeplate' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'themeplate' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>

    <?php endif; ?>

    <footer class="entry-footer">
        <?php
        themeplate_entry_footer();

        if ( ! is_singular() ) {
            echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html__( 'Read More', 'themeplate' ) . '<i class="fa fa-angle-right"></i> </a>';
        }
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->