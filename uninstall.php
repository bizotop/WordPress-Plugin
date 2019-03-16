<?php

/**
 * Fired when the plugin is uninstalled.
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// This array should be in sync with bizotop_options array which has been set in wp-bizotop-options.php
$bizotop_options = array(
    'bizotop-api-key',
    'bizotop-api-host',
);

foreach ($bizotop_options as $option) {
    delete_option($option);
}
