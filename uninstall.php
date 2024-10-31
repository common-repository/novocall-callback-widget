<?php
/* Fired when the plugin is uninstalled. */

// Exit if uninstall not called from WordPress
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Removes Novocall settings from the wp_options table
delete_option('novocall-widget-active-novocall');
delete_option('novocall-widget-code-novocall');