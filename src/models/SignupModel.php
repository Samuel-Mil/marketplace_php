<?php

namespace Src\Models;

use Src\MySql;
use Src\Bcrypt;

class SignupModel
{
	public static function store(
		string $login,
		string $password,
		string $stripe_acc
	)
	{
		$userAlreadyExists = MySql::connect()->prepare("SELECT * FROM `users` WHERE login = ?");
	    $userAlreadyExists->execute([$login]);

	    if($userAlreadyExists->rowCount() === 1){
	      die('This user already exists!');
	    }

		$sql = MySql::connect()->prepare("INSERT INTO `users` VALUES (null,?,?,?)");
		$sql->execute([$login,Bcrypt::hash($password),$stripe_acc]);

		$user = MySql::connect()->prepare("SELECT * FROM `users` WHERE login = ?");
	    $user->execute([$login]);

		if($user->rowCount() === 1){
			return $user->fetch()['id'];
		}
	}
}
