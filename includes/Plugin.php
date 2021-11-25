<?php

namespace LPT;

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
