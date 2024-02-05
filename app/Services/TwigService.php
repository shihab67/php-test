<?php

namespace App\Services;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class TwigService
{
	private $twig;

	public function __construct()
	{
		$loader = new FilesystemLoader(__DIR__ . '/../views');
		$this->twig = new Environment($loader);
		$this->twig->addGlobal('session', $_SESSION);
	}

	public function render(string $template, array $data = []): string
	{
		return $this->twig->render($template, $data);
	}
}
