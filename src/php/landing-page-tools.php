<?php
/**
 * Plugin Name:       @@PLUGIN_NAME
 * Plugin URI:        https://infografic.com.br
 * Description:       Plugin de gestão de Landing Pages.
 * Version:           @@PLUGIN_VERSION
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Rodrigo Gomes
 * Author URI:        https://infografic.com.br
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       landing-page-tools
 * Domain Path:       /languages
 *
 * @package         Landing_Page_Tools
 */

defined( 'ABSPATH' ) || exit;

define('LPT_PLUGIN_FILE', untrailingslashit(__FILE__));
define('LPT_PLUGIN_PATH', untrailingslashit( plugin_dir_path( LPT_PLUGIN_FILE) ));
define('LPT_PLUGIN_URL', untrailingslashit( plugins_url( '/', LPT_PLUGIN_FILE) ));

require_once LPT_PLUGIN_PATH . '/includes/Plugin.php';
//require_once LPT_PLUGIN_PATH . '/includes/Activate.php';
//require_once LPT_PLUGIN_PATH . '/includes/Deactivate.php';

if (class_exists('Plugin')){


	function LPT() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
		return Plugin::getInstance();
	}

	add_action('plugins_loaded', array(LPT(), 'init'));

	// activation
	//register_activation_hook(LPT_PLUGIN_FILE, array(LPT(), 'activate'));

	// deactivation
	//register_deactivation_hook(LPT_PLUGIN_FILE, array(LPT(), 'deactivate'));
}


