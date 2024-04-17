<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://trailblazecreative.com/
 * @since             1.0.0
 * @package           Trailblaze_Children_Page_List
 *
 * @wordpress-plugin
 * Plugin Name:       TrailBlaze Children Page List
 * Plugin URI:        https://github.com/TrailBlaze-Creative/TrailBlaze-Children-Page-List
 * Description:       Simple shortcode to display a list of child and grandchild pages of the specified parent page.
 * Version:           1.0.1
 * Author:            TrailBlaze Creative
 * Author URI:        https://trailblazecreative.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trailblaze-children-page-list
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TRAILBLAZE_CHILDREN_PAGE_LIST_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-trailblaze-children-page-list-activator.php
 */
function activate_trailblaze_children_page_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trailblaze-children-page-list-activator.php';
	Trailblaze_Children_Page_List_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-trailblaze-children-page-list-deactivator.php
 */
function deactivate_trailblaze_children_page_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trailblaze-children-page-list-deactivator.php';
	Trailblaze_Children_Page_List_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_trailblaze_children_page_list' );
register_deactivation_hook( __FILE__, 'deactivate_trailblaze_children_page_list' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-trailblaze-children-page-list.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_trailblaze_children_page_list() {

	$plugin = new Trailblaze_Children_Page_List();
	$plugin->run();

}

require plugin_dir_path( __FILE__ ) . 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/TrailBlaze-Creative/TrailBlaze-Children-Page-List',
    __FILE__,
    'trailblaze-children-page-list'
);

$myUpdateChecker->setBranch('main');

run_trailblaze_children_page_list();
