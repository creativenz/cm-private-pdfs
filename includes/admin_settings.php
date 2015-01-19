<?php

namespace Creativem\PrivatePDFs\AdminSettings;
use Creativem\PrivatePDFs\AdminSettings;

class Admin_Settings {
	
	/**
     * Holds the values to be used in the fields callbacks
     */
	private $options;
	
	/**
     * Start up
     */
	public function __construct() {
	  add_action( 'admin_menu', array( $this, 'cmpp_setup_menu' ) );
	  add_action( 'admin_init', array( $this, 'register_cmpp_settings' ) );
	}
	
	/**
     * Add options page
     */
	public function cmpp_setup_menu() {
		add_options_page( 'Private PDFs Settings', 'Private PDFs', 'manage_options', 'cmpp',  array( $this, 'cmpp_settings' ) );
	}
	
	/**
     * Options page callback
     */
	public function cmpp_settings() {
		// Set class property
        $this->options = get_option( 'cmpp_name' );
        ?>
		<div class="wrap">
			<h2>Private PDFs Settings</h2>
			<form method="post" action="options.php">
		<?php
			settings_fields( 'cmpp-group' );
			do_settings_sections( 'cmpp' );
			submit_button();
		?>
			</form>
		</div>
        <?php
	}
	
	/**
     * Register and add settings
     */
	public function register_cmpp_settings() {
		register_setting( 'cmpp-group', 'cmpp_name', array( $this, 'cmpp_sanitise' ) );
		
		add_settings_section( 'cmpp_settings', null, null, 'cmpp' );
		
		add_settings_field( 'secure_folder_name', 'Secure Folder Name', array( $this, 'name_callback' ), 'cmpp', 'cmpp_settings' );
	}
	
	/**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function cmpp_sanitise( $input ) {
        $new_input = array();

        if( isset( $input['secure_folder_name'] ) )
            $new_input['secure_folder_name'] = sanitize_text_field( $input['secure_folder_name'] );

        return $new_input;
    }
	
	/** 
     * Get the settings option array and print one of its values
     */
    public function name_callback()
    {
        printf(
            '<input type="text" id="title" name="cmpp_name[secure_folder_name]" value="%s" />',
            isset( $this->options['secure_folder_name'] ) ? esc_attr( $this->options['secure_folder_name']) : ''
        );
    }
}

new Admin_Settings();