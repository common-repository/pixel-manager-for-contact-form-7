<?php
/**
* This class is loaded on the front-end since its main job is
*/
class GMWPLW_Backend {
	
	public function __construct () {
		add_filter( 'wpcf7_editor_panels', array($this,'GMWPLW_custom_cf7_tab' ));
		add_action( 'wpcf7_after_save', array($this,'GMWPLW_save_custom_tab_data' ));
	}
	public function GMWPLW_custom_cf7_tab($panels)
	{
		$panels['gmwplw_tab'] = array(
	        'title' => __( 'Facebook Pixel', 'my-textdomain' ),
	        'callback' => array($this,'GMWPLW_cf7_tab_content' )
	    );
	    return $panels;
	}
	public function GMWPLW_cf7_tab_content(){
		$current_form = WPCF7_ContactForm::get_current();
		$post_id = $current_form->id();
		$gmwplw_facebook_pixel_events = get_post_meta( $post_id, 'gmwplw_facebook_pixel_events', true ) ;
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label>Enable/Disable</label>
					</th>
					<td>
						<input type="checkbox" name="gmwplw_enable_facebook_pixel" value="1" <?php checked( get_post_meta( $post_id, 'gmwplw_enable_facebook_pixel', true ), 1 ); ?> />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label>Facebook Pixel Id</label>
					</th>
					<td>
						<input type="text" name="gmwplw_facebook_pixel_id" value="<?php echo esc_attr( get_post_meta( $post_id, 'gmwplw_facebook_pixel_id', true ) ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label>Facebook Pixel Events</label>
					</th>
					<td>
						<select name="gmwplw_facebook_pixel_events">
							<option value="Contact" <?php echo selected( $gmwplw_facebook_pixel_events, 'Contact' ); ?>>Contact</option>
							<option value="Donate" <?php echo selected( $gmwplw_facebook_pixel_events, 'Donate' ); ?>>Donate</option>
							<option value="Lead" <?php echo selected( $gmwplw_facebook_pixel_events, 'Lead' ); ?>>Lead</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}	
	public function GMWPLW_save_custom_tab_data($cf7){
		$post_id = $cf7->id();
		$gmwplw_enable_facebook_pixel = isset( $_POST['gmwplw_enable_facebook_pixel'] ) ? 1 : 0;
		update_post_meta( $post_id, 'gmwplw_enable_facebook_pixel', $gmwplw_enable_facebook_pixel );
		update_post_meta($post_id, 'gmwplw_facebook_pixel_id', sanitize_text_field($_POST['gmwplw_facebook_pixel_id']));
		update_post_meta($post_id, 'gmwplw_facebook_pixel_events', sanitize_text_field($_POST['gmwplw_facebook_pixel_events']));
	}
}
?>