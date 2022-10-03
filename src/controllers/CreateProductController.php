<?php

namespace Src\Controllers;

use Src\View;
use Src\Response;
use Src\Models\CreateProductModel;

class CreateProductController
{
	public function index()
	{
		$model = new CreateProductModel();

		if(isset($_POST['acao'])){
			$name = strip_tags($_POST['name']);
			$description = strip_tags($_POST['description']);
		    $price = strip_tags($_POST['price']);
		    $content = strip_tags($_POST['content']);

		    $product = $model::store($name, $description, $price, $content);

		    if($product){
				Response::alert('Product was created successfully!');
				Response::redirect('/home');
		    	return true;
		    }else{
		    	return false;
		    }
		}

		return View::render('create_product');
	}
}
