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

//defined( 'ABSPATH' ) || exit;


define('LPT_PLUGIN_FILE', __FILE__);




if (class_exists('Plugin')){


	function LPT() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
		return Plugin::getInstance();
	}

	//Instanciar 2 objetos da classe plugin
	$plugin = LPT();


	$plugin_2 = LPT();
	$plugin->setVersion("1.0.0");

	$plugin->checkInstance();
	$plugin_2->checkInstance();

	if($plugin === $plugin_2){
		echo "nós somos iguais";
	}

}



/*// activation
register_activation_hook(LPT_PLUGIN_FILE, array($plugin, 'activate'));

// deactivation
register_deactivation_hook(LPT_PLUGIN_FILE, array($plugin, 'deactivate'));*/
