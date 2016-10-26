<?php
class Country_Info_ManageScripts {

  private $pluginUrl;

  public function __construct($pluginUrl)
  {
      $this->pluginUrl = $pluginUrl;
  }

  public function enqueueD2LJS($hook) {

		$active_page = get_option("d2l_country_info_options")["d2l_co_info_active_page"];

		if ($active_page == '' OR is_page($active_page)) {
			//enqueue JQuery script
			wp_enqueue_script( 'jquery' );
			//Add drlike script file with special functions.
			wp_register_script (
				'd2l-co-info-js',
				$this->pluginUrl . 'js/d2l-co-info.js',
				array( 'jquery' ),
				'',
				true
			);
		  wp_enqueue_script('d2l-co-info-js');

			wp_localize_script( 'd2l-co-info-js', 'd2l_co_info_ajax', array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' )
			));
		}
	}
}