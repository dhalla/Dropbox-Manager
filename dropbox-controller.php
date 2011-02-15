<?php
/**
 * @package Dropbox-Controller
 * @version 0.1
 */

/*
    Plugin Name: Dropbox-Controller
    Plugin URI: https://github.com/dhalla/Dropbox-Manager
    Description: Use the Dropbox CDN with this simple Wordpress-Plugin. Share even huge files with your visitors or allow them to upload their files into your DB-Account.
    Author: Daniel Haller
    Version: 0.1
    Author URI: https://github.com/dhalla
    License: GPL2
 
    Copyright 2011 Daniel Haller  (email : dha.mailings@googlemail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Enable debugging
define('WP_DEBUG', true);


// Register hooks
add_action('admin_menu', 'dc_admin_options_menu');
add_action('admin_menu', 'dc_admin_media_menu');


// Add new sub menu-item to top level-menuitem "media"
function dc_admin_media_menu() {
    add_submenu_page(
        'upload.php', // Media 
        'Dropbox File Manager', 
        'Dropbox', 
        'upload_files', // see http://codex.wordpress.org/Roles_and_Capabilities
        'dc',
        'dc_admin_media'
    );     
}


// Add new option page to the settings menu
function dc_admin_options_menu() {
    // simple wrapper for a call to add_submenu_page()
	add_options_page(
	   'Dropbox Options / Settings', 
	   'Dropbox Settings', 
	   'manage_options', 
	   'dc', 
	   'dc_admin_options'
    );
}


// Adminpage for users' dropbox-files
function dc_admin_media() {

	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

    echo '
<div class="wrap">
<h2>Dropbox &raquo; Manage your Files</h2>
</div>';

}


// Adminpage with settings for API-Key, Caching and so on
function dc_admin_options() {
	
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
    include('admin_options.html');
    
}
