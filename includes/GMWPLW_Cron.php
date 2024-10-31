<?php

class GMWPLW_Cron {
	
	public function __construct () {

		add_action( 'init', array( $this, 'GMWPLW_default' ) );
		
	}

	public function GMWPLW_default(){
		$defalarr = array(
			
			
			
		);
		
		foreach ($defalarr as $keya => $valuea) {
			if (get_option( $keya )=='') {
				update_option( $keya, $valuea );
			}
			
		}

		
		
	}
}

?>