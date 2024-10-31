<?php
/*
Plugin Name: Pixboom
Plugin URI: http://www.pixboom.com/
Description: Pixboom
Version: 0.1
Author: Pixboom AG
Author URI: http://www.pixboom.com/
License: GPL2
*/

/*
  Copyright 2011 Pixboom ( http://www.pixboom.com/ )

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

include 'pixboom_config_page.php';

register_deactivation_hook(__FILE__, 'pixboom_deactivate' );
add_action('wp_print_scripts', 'pixboom_enable');

if (is_admin()) {
    add_action('admin_menu', 'pixboom_admin_menu');
    add_action('admin_init', 'pixboom_register_options');
}

function pixboom_deactivate() {
    delete_option('pixboom_options');
}

function pixboom_enable() {
    $plugin_path = WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), "", plugin_basename(__FILE__));

    $opts = get_option('pixboom_options');

    if($opts['secret']) {
        wp_enqueue_script('pixboom_loader', $plugin_path . 'js/pixboom_loader.js', array(), false, true);
        wp_localize_script('pixboom_loader', 'PIXBOOM_SETTINGS', array('secret' => $opts['secret']));
    }
}

function pixboom_admin_menu() {
    add_options_page('Pixboom', 'Pixboom', 'administrator', 'pixboom', 'pixboom_config_page');
}

function pixboom_register_options() {
    register_setting('pixboom-options', 'pixboom_options', 'pixboom_sanitize');
}

function pixboom_sanitize($v) {
    $v['secret'] = wp_filter_nohtml_kses($v['secret']);

    return $v;
}

