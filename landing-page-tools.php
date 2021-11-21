<?php
/**
 * Plugin Name:       Landing Page Tools src
 * Plugin URI:        https://infografic.com.br
 * Description:       Plugin de gestão de Landing Pages.
 * Version:           0.1.0
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

final class Plugin
{

	private $version = "0.1.0";


	private static $_instance = null;

	/**
	 * The Singleton's constructor should always be private to prevent direct
	 * construction calls with the `new` operator.
	 */
	protected function __construct() { }

	/**
	 * Singletons should not be cloneable.
	 */
	protected function __clone() { }

	/**
	 * Singletons should not be restorable from strings.
	 */
	protected function __wakeup() { }

	public static function getInstance() : ?Plugin
	{
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function checkInstance()
	{
		echo "Este é o Objeto " , spl_object_id($this) , " da classe plugin versão ", $this->getVersion() , "\n" ;
	}

	/**
	 * @return string
	 */
	public function getVersion(): string
	{
		return $this->version;
	}

	/**
	 * @param string $version
	 */
	public function setVersion(string $version): void
	{
		$this->version = $version;
	}

}


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
