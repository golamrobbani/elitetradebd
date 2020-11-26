<?php
class Terms {
	/**
	 * Terms constructor.
	 */
	protected static $instance = null;
	public function __construct() {
		add_action( 'download_category_add_form_fields', array( $this, 'download_categorys_add_meta_fields' ), 10, 1 );
		add_action( 'download_category_edit_form_fields', array( $this, 'download_categorys_edit_meta_fields' ), 10, 2 );
		add_action( 'create_download_category', array( $this, 'save_download_category_term_meta' ), 10, 2 );
		add_action( 'edited_download_category', array( $this, 'save_download_category_term_meta' ), 10, 2 );

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	public function download_categorys_add_meta_fields() {
		?>
		<div class="form-field">
			<label for="_category_image"><?php _e( 'Category Image', 'themeplate' ); ?></label>
			<input type="text" name="_category_image" id="download-file1" class="ever-field"
			value=" "/>
			<a href="#" id="set-download-file" class="thickbox"
			style="text-align: left;display: inline-block;margin: 5px 0;">Set Download File</a>
		</div>
		<script>
			jQuery('#set-download-file').click(function () {
				var send_attachment_bkp = wp.media.editor.send.attachment;
				wp.media.editor.send.attachment = function (props, attachment) {
					jQuery('#download-file1').val(attachment.url);
					wp.media.editor.send.attachment = send_attachment_bkp;
				};
				wp.media.editor.open();
				return false;
			});
		</script>
		<?php
	}



	public function download_categorys_edit_meta_fields( $term ) {
		$term_id  = $term->term_id;
		$download_file_url   = get_term_meta( $term_id, '_category_image', true);
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="_category_image"><?php _e( 'Category Image', 'themeplate' ); ?></label>
			</th>
			<td>
				<input type="text" name="_category_image" id="download-file2" class="ever-field"
				value="<?php echo $download_file_url; ?>"/>
				<a href="#" id="set-download-file" class="thickbox"
				style="text-align: left;display: inline-block;margin: 5px 0;">Set Download File</a>
			</td>
		</tr>

		<script>
			jQuery('#set-download-file').click(function () {
				var send_attachment_bkp = wp.media.editor.send.attachment;
				wp.media.editor.send.attachment = function (props, attachment) {
					jQuery('#download-file2').val(attachment.url);
					wp.media.editor.send.attachment = send_attachment_bkp;
				};
				wp.media.editor.open();
				return false;
			});
		</script>
		<?php
	}

	public function save_download_category_term_meta( $term_id ) {
		$category_image   = empty( $_POST['_category_image'] ) ? '' : esc_sql( $_POST['_category_image'] );
		update_term_meta( $term_id, '_category_image', $category_image );
		
	}


	
}
function cd_custom_term_metabox() {
	return Terms::instance();
}

cd_custom_term_metabox();
