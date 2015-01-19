<?php
/**
 * Plugin Name: Creative Marketing Private PDFs
 * Plugin URI: http://creativem.co.nz/
 * Description: Allows for PDF statements to be issued privately to users on website.
 * Version: 1.0.0
 * Author: Jessica Christini, Kevin Phillips
 * Author URI: http://creativem.co.nz/
 * License: GPL3
 */
 
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class PrivatePdfsSettings {
	
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
		add_submenu_page( 'options-general.php', 'Private PDFs Settings', 'Private PDFs', 'manage_options', 'cmpp', 'cmpp_settings' );
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
			do_settings_sections( 'cmpp-group' );
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
		register_setting( 'cmpp-group', 'cmpp_name', array( $this, 'sanitise' ) );
		
		add_settings_field( 'secure_folder_name', 'Secure Folder Name', array( $this, 'name_callback' ), 'cmpp' );
	}
	
	/**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitise( $input ) {
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

if( is_admin() )
    $my_settings_page = new PrivatePdfsSettings();