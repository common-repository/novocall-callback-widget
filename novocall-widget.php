<?php
/*
Plugin Name: Novocall - Callback Widget
Description: Novocall is a powerful callback widget that integrates beautifully with WordPress websites.
Version: 1.0.0
Author: Novocall
Author URI: https://www.novocall.co/
License: GPLv2 or later
*/

/*
Copyright (C) 2018 Novocall

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

defined('ABSPATH') or die();

class NovocallPlugin {
	function __construct() {
		// When the plugin is activated, the admin_menu function is executed
		add_action('admin_menu', array(&$this, 'admin_menu'));

		$this->plugin_name = 'novocall-widget';
		$this->version = '1.0.0';
		$this->define_public_hooks();
		$this->define_filters();
	}

	function activate() {
	}

	function deactivate() {
		
	}

	function admin_menu() {
		// Adds the 'Novocall' page under 'Settings' in the main WordPress admin sidebar
		add_options_page('Novocall', 'Novocall', 'manage_options', $this->plugin_name, array(&$this, 'load_admin_menu'));

		// Executes the update_novocall_widget_settings function when the user visits the settings page
		add_action( 'admin_init', array(&$this, 'update_novocall_widget_settings' ));
	}

	function load_admin_menu() {
		include_once('display/novocall-widget-admin-page.php');
	}

	function define_public_hooks() {
		// Execute init_novocall_injection every time the plugin is initialised
		add_action( 'init', array(&$this, 'init_novocall_injection') );
	}

	function define_filters() {
		// Adds the returned value from add_action_links to the plugins page
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__) , array( &$this, 'add_action_links' ));
	}

	function add_action_links($links) {
		 $link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );

	   return array_merge(  $link, $links );
	}

	function init_novocall_injection() {
		// Check if the widget is enabled
		if (get_option('novocall-widget-active-novocall')) {
			// Check if the javascript code has been set
			if (get_option('novocall-widget-code-novocall')) {
				add_action( 'wp_footer', array( &$this, 'inject_novocall' ) );
			}
		}
	}

	function inject_novocall() {
		// Outputs the text in the novocall-widget-code-novocall option into the footer
		echo get_option('novocall-widget-code-novocall');
	}

	function update_novocall_widget_settings() {
		// Add the relevant rows to the wp_options table in the db to store the settings
		register_setting( $this->plugin_name . '-settings', $this->plugin_name . '-active-novocall' );
		register_setting( $this->plugin_name . '-settings', $this->plugin_name . '-code-novocall' );
	}
}

register_activation_hook(__FILE__, array('NovocallPlugin', 'activate'));
register_deactivation_hook(__FILE__, array('NovocallPlugin', 'deactivate'));

new NovocallPlugin();