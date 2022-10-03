<?php

namespace Src\Models;

use Src\MySql;
use Src\Bcrypt;
use Src\Response;

class LoginModel
{
	public static function login(string $login, string $password)
	{
		$userExists = MySql::connect()->prepare("SELECT * FROM `users` WHERE login = ?");
		$userExists->execute([$login]);

		if($userExists->rowCount() == 1){
			$userPassword = $userExists->fetch()['password'];

			if(!Bcrypt::check($password, $userPassword)){
				return false;
			}

			$sql = MySql::connect()->prepare("SELECT * FROM `users` WHERE login = ? AND password = ?");
			$sql->execute([$login,$userPassword]);

			if($sql->rowCount() == 1){
				return $sql->fetch()['id'];
			}else{
				Response::alert("User or password is incorrect!");
				return false;
			}

		}else{
			Response::alert("User not exists!");
			return false;
		}

	}
}
