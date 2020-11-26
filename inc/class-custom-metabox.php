<?php

class MetaBox {
	/**
	 * The single instance of the class.
	 *
	 * @var themeplate
	 * @since 1.0.0
	 */

	protected static $instance = null;

	/**
	 * MetaBox constructor.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
		add_action( 'save_post_service', array( $this, 'save_service_post_meta' ) );
		add_action( 'add_meta_boxes', array( $this, 'register_feature_images_meta_boxes' ) );
		add_action( 'save_post_download', array( $this, 'save_term_images_meta_boxes' ), 10, 1 );
		
		
		add_action( 'add_meta_boxes', array( $this, 'create_images_meta_boxes' ) );
		add_action( 'save_post_download', array( $this, 'save_images_meta_boxes' ), 10, 1 );
	}


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register_meta_boxes() {
		add_meta_box( 'cd_service', 'Service Icon', array(
			$this,
			'render_item_meta_metabox'
		), 'service', 'normal', 'high' );
	}

	public function register_feature_images_meta_boxes() {
		add_meta_box( 'cd_feature_img', 'Slider Option', array(
			$this,
			'show_feature_image_script'
		), 'download', 'side', 'high' );
	}


	public function show_feature_image_script($post)
	{
		$slider_image = get_post_meta($post->ID, '_slider_image', true);
		$slider_active = get_post_meta($post->ID, '_slider_active', true);
		$slider_background = get_post_meta($post->ID, '_slider_background', true);

		?>
		<div class="ever-row">
			<p class="ever-col-2">
				<strong class="ever-label">Active Slider Image</strong>
			</p>
			<label class="selectit">
				<input type="checkbox" name="_slider_active" id="in-download_category-10" value="1" <?php checked( $slider_active, 1 ); ?>>
			</label>
		</div>

		<div class="ever-row">
			<p class="ever-col-2">
				<strong class="ever-label">Slider Image Background</strong>
			</p>
			<label class="selectit">
				<input type="text" name="_slider_background" id="slider_background" class="medium-text"
				value="<?php echo $slider_background; ?>"/>
			</label>
		</div>

		<div class="ever-row">
			<p class="ever-col-2">
				<strong class="ever-label">Set Slider Image</strong>
			</p>
			<div class="ever-col-10">
				<div class="ever-col-3">
					<input type="text" name="_slider_image" id="slider-image" class="widefat"
					value="<?php echo $slider_image; ?>"/>
					<a href="#" id="set-slider-image" class="thickbox"
					style="text-align: left;display: inline-block;margin: 5px 0;">Set Slider Image</a>
					
				</div>
			</div>
		</div>

		
		<script>
			jQuery('#set-slider-image').click(function () {
				var send_attachment_bkp = wp.media.editor.send.attachment;
				wp.media.editor.send.attachment = function (props, attachment) {
					jQuery('#slider-image').val(attachment.url);
					wp.media.editor.send.attachment = send_attachment_bkp;
				};
				wp.media.editor.open();
				return false;
			});
		</script>
		<?php

	}


	public function render_item_meta_metabox( $post ) {
		$cd_service_metavalues = get_post_meta( get_the_ID(), 'service_icon_key', true );
		if ( ! $cd_service_metavalues ) {
			$cd_service_metavalues['service_icon'] = '';
		}
		?>
		<div class="form-group">
			<label for="service_icon"><?php _e( 'Service Icon', 'rsp' ); ?></label>
			<input value="<?php echo esc_attr( $cd_service_metavalues['service_icon'] ); ?>" id="service_icon"
			type="text" class="form-field" name="service_icon"/>
		</div>
		<?php
	}

	public function save_service_post_meta( $post_id ) {
		if ( get_post_type( $post_id ) != 'service' ) {
			return;
		}
		$cd_service_metavalues['service_icon'] = sanitize_text_field( $_POST['service_icon'] );
		update_post_meta( $post_id, 'service_icon_key', $cd_service_metavalues );
	}

	public function create_images_meta_boxes() {
		add_meta_box( 'edd_download_info_metabox', esc_html__( 'Download Image Gallary', 'themeplate' ), array(
			$this,
			'edd_download_files_meta_box'
		), 'download', 'normal', 'core' );
	}

	public function edd_download_files_meta_box() {

		global $post;
		$images = get_post_meta( $post->ID, '_chartdynamix_files', true );
		$count  = 1;

		if ( $images !== '' ) { ?>

			<div class="edd-file-fields edd-repeatables-wrap ui-sortable">

				<?php foreach ( $images as $image ) { ?>
					<div class="edd_repeatable_upload_wrapper edd_repeatable_row" data-key="1">
						<div class="edd-repeatable-row-header edd-draghandle-anchor">
							<span class="edd-repeatable-row-actions">
								<a class="edd-remove-row edd-delete" data-type="file">Remove<span
									class="screen-reader-text">Remove file 1</span>
								</a>
							</span>
						</div>
						<div class="edd-repeatable-row-standard-fields">
							<div class="edd-file-url">
								<span class="edd-repeatable-row-setting-label">Image URL</span>
								<div class="edd_repeatable_upload_field_container">
									<span id="edd-edd_download_files1file-wrap">
										<input type="text" name="chartdynamix[<?php echo $count; ?>]" id=""
										autocomplete=""
										value="<?php echo $image; ?>" placeholder="Upload or enter the file URL"
										class="edd_repeatable_upload_field edd_upload_field large-text">
									</span>
									<span class="edd_upload_file">
										<a href="#" data-uploader-title="Insert File" data-uploader-button-text="Insert"
										class="edd_upload_file_button" onclick="return false;">Upload an Image</a>
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php $count ++;
				} ?>

				<div class="edd-add-repeatable-row">
					<div class="submit" style="float: none; clear:both; background: #fff;">
						<button class="button-secondary edd_add_repeatable">Add New File</button>
					</div>
				</div>
			</div>

			<?php } else { ?>

				<div class="edd-file-fields edd-repeatables-wrap ui-sortable">
					<div class="edd_repeatable_upload_wrapper edd_repeatable_row" data-key="1">
						<div class="edd-repeatable-row-header edd-draghandle-anchor">
							<span class="edd-repeatable-row-actions">
								<a class="edd-remove-row edd-delete" data-type="file">Remove<span
									class="screen-reader-text">Remove file 1</span>
								</a>
							</span>
						</div>

						<div class="edd-repeatable-row-standard-fields">
							<div class="edd-file-url">
								<span class="edd-repeatable-row-setting-label">Image URL</span>
								<div class="edd_repeatable_upload_field_container">
									<span id="edd-edd_download_files1file-wrap"><input type="text" name="chartdynamix[1]"
										id=""
										autocomplete="" value=""
										placeholder="Upload or enter the file URL"
										class="edd_repeatable_upload_field edd_upload_field large-text">
									</span>
									<span class="edd_upload_file">
										<a href="#" data-uploader-title="Insert File" data-uploader-button-text="Insert"
										class="edd_upload_file_button" onclick="return false;">Upload an Image</a>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="edd-add-repeatable-row">
						<div class="submit" style="float: none; clear:both; background: #fff;">
							<button class="button-secondary edd_add_repeatable">Add New File</button>
						</div>
					</div>
				</div>
				<?php }
			}


			public function save_images_meta_boxes( $post_id ) {
				if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
					return false;
				}

				if ( ! isset( $_POST['chartdynamix'] ) ) {
					return;
				}

				update_post_meta( $post_id, '_chartdynamix_files', $_POST['chartdynamix'] );
			}

			public function save_term_images_meta_boxes( $post_id ) {
				$slider_active = empty( $_POST['_slider_active'] ) ? '' : esc_attr( $_POST['_slider_active'] );
				$slider_background = empty( $_POST['_slider_background'] ) ? '' : esc_attr( $_POST['_slider_background'] );
				$slider_image = empty( $_POST['_slider_image'] ) ? '' : esc_url( $_POST['_slider_image'] );

				update_post_meta( $post_id, '_slider_image', $slider_image );
				update_post_meta( $post_id, '_slider_active', $slider_active );
				update_post_meta( $post_id, '_slider_background', $slider_background );
			}


		}

		function cd_custom_metabox() {
			return MetaBox::instance();
		}

		cd_custom_metabox();
