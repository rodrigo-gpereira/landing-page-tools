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

// Your code starts here.

defined( 'ABSPATH' ) || exit;

class Plugin
{

	public function activate()
	{
		flush_rewrite_rules();
	}

	public function deactivate()
	{
		flush_rewrite_rules();
	}

}

if (class_exists('Plugin')){

	define('LPT_PLUGIN_FILE', __FILE__);

	$plugin = new Plugin();
}


// activation
register_activation_hook(LPT_PLUGIN_FILE, array($plugin, 'activate'));

// deactivation
register_deactivation_hook(LPT_PLUGIN_FILE, array($plugin, 'deactivate'));
