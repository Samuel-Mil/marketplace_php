<?php

namespace Src;

use \Dotenv\Dotenv;
use \Stripe\Stripe;

class Application
{
	public static Application $app;
	public Response $response;
	public View $view;
	public MySql $mysql;

	public function __construct()
	{
		$this->loadEnvVariables();
		$this->generateStripeApiKey();

		self::$app = $this;
		$this->response = new Response();
		$this->view = new View();
		$this->mysql = new MySql();
	}

	public function run()
	{
		$path = "Src\Controllers";
		$url = isset($_GET['url']) ? explode('/',$_GET['url']) : '';

		if(@$url[0] == ''){
			$this->response::redirect('/home');
		}

		for($i = 0; $i < count($url); $i++){
			$path .= "\\".ucfirst($url[$i]);
			$last_array_index = array_key_last($url) ?? '';
			$path .= preg_replace('/[0-9]+/', '', str_replace('\\', '', $last_array_index));
		}

		$path .= 'Controller';

		if(class_exists($path)){
			$controller = new $path();
			return $controller->index();
		}else{
			return $this->response::redirect('/notFound');
		}
	}

	private function loadEnvVariables()
	{
		$dotenv = Dotenv::createImmutable(dirname(__DIR__));
		$dotenv->load();
		define('APP_URL', $_ENV['APP_URL']);
	}

	private function generateStripeApiKey()
	{
		return Stripe::setApiKey($_ENV['STRIPE_API_KEY']);
	}
}
