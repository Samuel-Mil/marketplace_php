<?php

namespace Src;

class Response
{

	public function __construct()
	{
		if(isset($_GET['logout'])){
			self::destroySessions();
			self::redirect('/home');
    	}
	}

	public static function setStatusCode(int $code)
	{
		return http_response_code($code);
	}

	public static function redirect(string $url)
	{
		return header('Location: '.APP_URL.$url);
	}

	public static function alert(string $message)
	{
		echo '<script>alert("'.$message.'")</script>';
		return;
	}

	public static function isLogged(string $url = '')
	{
		if(isset($_SESSION['login']) && $url != ""){
			self::redirect($url);
			return true;
		}else if(!isset($_SESSION['login']) && !$url)
			return false;
	}

	public static function destroySessions()
	{
		session_destroy();
    	session_unset();
    	return;
	}
}
