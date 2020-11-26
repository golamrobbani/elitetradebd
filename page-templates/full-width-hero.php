<?php
/*
 * Template Name: Full Width With Breadcrumb
 */

get_header();
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

                <div class="col-md-12">
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        the_content();

                    endwhile; // End of the loop.
                    ?>
                </div>

            </div>
        </div>
    </section>

<?php
get_footer();
