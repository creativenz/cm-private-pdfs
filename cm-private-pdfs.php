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

namespace Creativem\PrivatePDFs;
use Creativem\PrivatePDFs;

function load_includes() {
	if ( is_admin() ) {
		include 'includes/admin_settings.php';
	}
}

add_action( 'init', __NAMESPACE__.'\load_includes' );