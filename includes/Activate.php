<?php

namespace LPT;

defined( 'ABSPATH' ) || exit;

class Activate
{
	protected function __construct()
	{
	}

	public static function activate()
	{
		echo"ativei o plugin";
		flush_rewrite_rules();
	}

}
