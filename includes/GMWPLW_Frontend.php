<?php

/**
 * This class is loaded on the front-end since its main job is 

 */

class GMWPLW_Frontend {
	
	public function __construct () {
		add_action( 'wp_enqueue_scripts',  array( $this, 'GMWPLW_insta_scritps' ) );

		add_action( 'wp_footer', array($this,'GMWPLW_cf7_gpa_plugin_script'), 21, 1 );
		add_action( 'wpcf7_before_send_mail',  array($this,'GMWPLW_cf7_api_sender' ));

	}
	public function GMWPLW_insta_scritps () {

	}
	public function GMWPLW_cf7_api_sender ($contact_form) {
		$gmwplw_enable_facebook_pixel=get_post_meta( $contact_form->id, 'gmwplw_enable_facebook_pixel', true );
		if($gmwplw_enable_facebook_pixel==true){
			$submission = WPCF7_Submission::get_instance();
			$cuarl=array(
				'gmwplw_facebook_pixel_id' => get_post_meta( $contact_form->id, 'gmwplw_facebook_pixel_id', true ),
				'gmwplw_facebook_pixel_events' => get_post_meta( $contact_form->id, 'gmwplw_facebook_pixel_events', true ),
			);
			$submission->add_result_props( $cuarl);
		}

	}
	public function GMWPLW_cf7_gpa_plugin_script() 
	{
			?>
			<script>
				!function(f,b,e,v,n,t,s)
				  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
				  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
				  n.queue=[];t=b.createElement(e);t.async=!0;
				  t.src=v;s=b.getElementsByTagName(e)[0];
				  s.parentNode.insertBefore(t,s)}(window, document,'script',
				  'https://connect.facebook.net/en_US/fbevents.js');
				document.addEventListener( 'wpcf7mailsent', function( event ) {
					// console.log(event);
					 console.log(event.detail.apiResponse);
					  fbq('init', event.detail.apiResponse.gmwplw_facebook_pixel_id);
					  fbq('track', event.detail.apiResponse.gmwplw_facebook_pixel_events);
					
				}, false );
			</script>
			<?php
	}
}