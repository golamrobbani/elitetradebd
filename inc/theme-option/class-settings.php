<?php
require get_template_directory() . '/inc/theme-option/class-settings-api.php';

class CD_theme_option {
	private $settings_api;

	function __construct() {
		$this->settings_api = new \Ever_WP_Settings_API();
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	function admin_init() {
		//set the settings
		$this->settings_api->set_sections( $this->get_settings_sections() );
		$this->settings_api->set_fields( $this->get_settings_fields() );
		//initialize settings
		$this->settings_api->admin_init();
	}

	function admin_menu() {
		add_theme_page( 'Theme option', 'Theme option', 'manage_options', 'themplate-settings', array(
			$this,
			'settings_page'
		) );
	}

	function get_settings_sections() {
		$sections = array(
			array(
				'id'    => 'cd_footer_settings',
				'title' => __( 'Footer Settings', 'themeplate' )
			)
		);

		return $sections;
	}

	/**
	 * Returns all the settings fields
	 *
	 * @return array settings fields
	 */
	function get_settings_fields() {
		$settings_fields = array(
			'cd_footer_settings' => array(
				array(
					'name'  => 'copy_right',
					'label' => __( 'Copyright', 'themeplate' ),
					'type'  => 'text',
				),
				array(
					'name'  => 'footer_notice',
					'label' => __( 'Notice', 'themeplate' ),
					'type'  => 'wysiwyg',
				),

				array(
					'name'  => 'header_news',
					'label' => __( 'Header News', 'themeplate' ),
					'type'  => 'wysiwyg',
				),
				array(
					'name'  => 'facebook_url',
					'label' => __( 'Facebook URL', 'themeplate' ),
					'type'  => 'text',
				),
				array(
					'name'  => 'twitter_url',
					'label' => __( 'Twitter URL', 'themeplate' ),
					'type'  => 'text',
				),
				array(
					'name'  => 'vimeo_url',
					'label' => __( 'Vimeo URL', 'themeplate' ),
					'type'  => 'text',
				),
				array(
					'name'  => 'youtube_url',
					'label' => __( 'Youtube URL', 'themeplate' ),
					'type'  => 'text',
				),
				array(
					'name'  => 'rss_url',
					'label' => __( 'Rss URL', 'themeplate' ),
					'type'  => 'text',
				)
			)


		);

		return $settings_fields;
	}

	function settings_page() {
		?>
		<?php
		echo '<div class="wrap">';
		echo sprintf( "<h2>%s</h2>", __( 'Chart Dynamix Theme Option', 'themeplate' ) );
		$this->settings_api->show_settings();
		echo '</div>';
	}

	/**
	 * Get all the pages
	 *
	 * @return array page names with key value pairs
	 */
	function get_pages() {
		$pages         = get_pages();
		$pages_options = array();
		if ( $pages ) {
			foreach ( $pages as $page ) {
				$pages_options[ $page->ID ] = $page->post_title;
			}
		}

		return $pages_options;
	}
}

new CD_theme_option();
