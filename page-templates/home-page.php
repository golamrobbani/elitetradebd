<?php
/*
 * Template Name: Home Pgae
 */
get_header();
?>


<?php get_template_part('loop-templates/feature', 'sliders');?>



<section class="content-area" style="background: #f5f5f5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
		  <?php
$header_news = themeplate_get_settings('header_news');
if (!empty($header_news)) {
    ?>
			  <div class="tcontainer">
				  <style>@keyframes ticker {
							 0% { transform: translate3d(0, 0, 0); }
							 100% { transform: translate3d(-100%, 0, 0); }
						 }
					  .tcontainer{
						  width: 100%;
						  overflow: hidden;
						  margin-bottom: 20px;
					  }
					  .ticker-wrap {
						  width: 100%;
						  padding-left: 100%;
						  background-color: #eee;
					  }
					  .ticker-move {
						  display: inline-block;
						  white-space: nowrap;
						  padding-right: 100%;
						  -webkit-animation: ticker 800s infinite;
                           animation: ticker 800s infinite;;
					  }
					  .ticker-move:hover{
						  animation-play-state: paused;
					  }
					  .ticker-item{
						  display: inline-block;
						  padding: 0 2rem;
						  line-height: 40px;
					  }</style>
				  <div class="ticker-wrap">
					  <div class="ticker-move">
						  <div class="ticker-item"><?php echo $header_news; ?></div>
					  </div>
				  </div>
			  </div>
		  <?php }?>


		  <?php get_template_part('loop-templates/partials/popular', 'product');?>

        <?php get_template_part('loop-templates/partials/product', 'category');?>


        <?php echo do_shortcode('[cd_category_by_product type="download" title="On Sale Now" cat="scientific-and-surgical" limit="6"]'); ?>


        <?php echo do_shortcode('[cd_category_by_product type="download" title="On Sale Now" cat="food-and-beverage" limit="6"]'); ?>

        <?php get_template_part('loop-templates/partials/product', 'justForYou');?>


      </div>

    </div>
  </div>
</section>


<?php get_template_part('loop-templates/partials/brand-banner');?>

<?php
get_footer();
