<?php

namespace Src\Controllers;

use Src\View;
use Src\Response;
use Src\Models\HomeModel;

class HomeController
{
	public function index()
	{
		$model = new HomeModel();
		$products = $model::getProducts();

		if(!Response::isLogged()){
			$userHaveStripeAccount = '';

			if(!$userHaveStripeAccount){
				echo '<div class="container"><div class="alert alert-warning mt-2" role="alert">
		 			You are not connected in your stripe account!
		 			<a href="'.$userHaveStripeAccount.'" class="mr-1">please do that</a>.
				</div></div>';
			}
		}

		if(isset($_GET['paymentSuccess'])){
			echo '<div class="container"><div class="alert alert-success mt-1" role="alert">
		 		Payment successffully!
			</div></div>';
		}

		if(isset($_GET['paymentError'])){
			echo '<div class="container"><div class="alert alert-danger mt-1" role="alert">
		  	Payment error! try again
			</div></div>';
		}

		return View::render('home', [
			'products' => $products,
			'model'	   => $model
		]);
	}
}
