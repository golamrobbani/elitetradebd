<?php

class ShortCode {
	/**
	 * The single instance of the class.
	 *
	 * @var themeplate
	 * @since 1.0.0
	 */
	protected static $instance = null;

	/**
	 * ShortCode constructor.
	 */
	public function __construct() {
		add_shortcode( 'cd_footer_tab', array( $this, 'themeplate_footer_tab' ) );
		add_shortcode( 'testimonials', array( $this, 'themeplate_testimonial' ) );
		add_shortcode( 'cd_category_by_product', array( $this, 'render_cd_category_by_post' ) );
		
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public static function cd_set_post_views( $postID ) {
		$countKey = 'cd_post_views_count';
		$count    = get_post_meta( $postID, $countKey, true );
		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $postID, $countKey );
			add_post_meta( $postID, $countKey, '0' );
		} else {
			$count ++;
			update_post_meta( $postID, $countKey, $count );
		}
	}

    public static function edd_popular_product_view( $postID ) {
        $countKey = 'edd_product_view_count';
        $count    = get_post_meta( $postID, $countKey, true );
        if ( $count == '' ) {
            $count = 0;
            delete_post_meta( $postID, $countKey );
            add_post_meta( $postID, $countKey, '0' );
        } else {
            $count ++;
            update_post_meta( $postID, $countKey, $count );
        }
    }

	function themeplate_footer_tab( $atts ) {
		$cd_atts = shortcode_atts( array(
			'limit' => 3
		), $atts, 'themeplate' );

		ob_start();
		require get_template_directory() . '/loop-templates/footer-widget-tab.php';

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}

	function themeplate_testimonial( $atts ) {
		$testimonial_atts = shortcode_atts( array(
			'limit' => - 1
		), $atts, 'themeplate' );

		ob_start();
		require get_template_directory() . '/loop-templates/testimonial-loop.php';

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}

	public function render_cd_category_by_post($atts)
	{
		$cat_atts = shortcode_atts(array(
			'title' => '',
			'cat' => '',
			'limit' => 5,
			'column' => '2',
			'type' => 'download'
		), $atts, 'themeplate');
		extract($cat_atts);
		ob_start();
		require get_template_directory() . '/loop-templates/partials/product-card.php';
		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}


}

function cd_short_code() {
	return ShortCode::instance();
}

//fire off the theme
cd_short_code();
