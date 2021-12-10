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
		flush_rewrite_rules();
	}

}
