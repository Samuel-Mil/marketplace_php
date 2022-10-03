<?php

namespace Src\Auth\Controllers;

use Src\View;
use Src\Response;

use Src\Models\SignupModel;

class SignupController
{
	public function index()
	{
		$model = new SignupModel();
		Response::isLogged('/home');

		if(isset($_POST['acao'])){
			$login = strip_tags($_POST['login']);
			$password = strip_tags($_POST['password']);
	    	$stripe_acc = strip_tags($_POST['stripe_acc']);

			$user = $model::store($login, $password, $stripe_acc);

			if($user){
				$_SESSION['login'] = $login;
				$_SESSION['user_id'] = $user;
				Response::redirect('/home');
			}
		}


		return View::render('signup');
	}
}
