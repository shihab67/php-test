<?php

namespace App\Controllers;

use App\Services\TwigService;

class Controller
{
	protected $twig;

	public function __construct()
	{
		$twigService = new TwigService();
		$this->twig = $twigService;
	}
}
