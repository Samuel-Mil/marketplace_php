<?php

namespace Src\Controllers\Auth;

use Src\View;
use Src\Response;
use Src\Models\LoginModel;

class LoginController
{
	public function index()
	{
		$model = new LoginModel();
		Response::isLogged('/home');

		if(isset($_POST['acao'])){
			$login = strip_tags($_POST['login']);
			$password = strip_tags($_POST['password']);

			$user = $model::login($login, $password);
			if($user){
				$_SESSION['login'] = $login;
				$_SESSION['user_id'] = $user;
				Response::redirect('/home');
				return true;
			}
		}
		return View::render('login');
	}
}
