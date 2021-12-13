<?php

use LPT\Includes\Activate;
use LPT\Includes\Deactivate;

defined( 'ABSPATH' ) || exit;


final class Plugin
{

	private $version = "0.1.0";


	private static $_instance = null;

	/**
	 * The Singleton's constructor should always be private to prevent direct
	 * construction calls with the `new` operator.
	 */
	protected function __construct()
	{

	}

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

	public function init()
	{
	}

	public function activate()
	{
		Activate::activate();
	}

	public function deactivate()
	{
		Deactivate::deactivate();
	}

}
