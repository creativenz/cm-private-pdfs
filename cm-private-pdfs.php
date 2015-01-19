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


if ( is_admin() ){ // admin actions
  add_action( 'admin_menu', 'cmpp_setup_menu' );
  add_action( 'admin_init', 'register_cmpp_settings' );
} else {
  // non-admin enqueues, actions, and filters
}


function cmpp_setup_menu() {
	add_submenu_page( 'options-general.php', 'Private PDFs Settings', 'Private PDFs', 'manage_options', 'cmpp', 'cmpp_settings' );
}

function cmpp_settings() {
	echo '<div class="wrap">';
	echo '<h2>Private PDFs Settings</h2>';
	echo '<form method="post" action="options.php">';
	
	settings_fields( 'cmpp-group' );
	
	do_settings_sections( 'cmpp-group' );
	
	echo '<table class="form-table">';
		echo '<tr valign="top">';
			echo '<th scope="row">Secure Folder Name</th>';
			echo '<td><input type="test" name="secure_folder_name" value="'. esc_attr( get_option( 'secure_folder_name' ) ) .'" /></td>';
		echo '</tr>';
	echo '</table>';
	
	submit_button();
	echo '</form>';
	echo '</div>';
}

function register_cmpp_settings() {
	register_setting( 'cmpp-group', 'secure_folder_name' );
}