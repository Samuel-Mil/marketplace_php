<?php

namespace Src\Models;

use Src\MySql;

class CreateProductModel
{
	public static function store(
		string $name,
		string $description,
		string $price,
		string $content,
	){
		$productAlreadyExists = MySql::connect()->prepare("SELECT * FROM `products` WHERE name = ?");
	    $productAlreadyExists->execute([$name]);

	    if($productAlreadyExists->rowCount() === 1){
	      die('This product already exists!');
	    }

		$sql = MySql::connect()->prepare("INSERT INTO `products` VALUES (null,?,?,?,?,?)");
		$sql->execute([$name,$description,$price,$_SESSION['user_id'],$content]);

		if($sql->rowCount() === 1){
			return true;
		}

		return false;
	}
}
