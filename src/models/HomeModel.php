<?php

namespace Src\Models;

use Src\MySql;
use Src\Response;
use \Stripe\Stripe;

class HomeModel
{
	public static function getProducts()
	{
		$sql = Mysql::connect()->prepare("SELECT * FROM `products`");
		$sql->execute();
		$products = $sql->fetchAll();
		return $products;
	}

	public static function getUser(int $id)
	{
		$sql = MySql::connect()->prepare("SELECT `login` FROM `users` WHERE id = ?");
		$sql->execute([$id]);
		$user = $sql->fetch()['login'];
		return $user;
	}

	public static function setStripeSession(array $product)
	{
		$session = \Stripe\Checkout\Session::create([
		    'line_items' => [[
		      'price_data' => [
		        'currency' => 'brl',
		        'product_data' => [
		          'name' => $product['name'],
		        ],
		        'unit_amount' => $product['price']*100,
		      ],
		      'quantity' => 1,
		    ]],
		    'mode' => 'payment',
		    'success_url' => APP_URL.'/home?paymentSuccess&code={CHECKOUT_SESSION_ID}',
		    'cancel_url' => APP_URL.'/home?paymentError&code={CHECKOUT_SESSION_ID}',
	  	]);

	  	return $session;
	}

	public static function userHaveStripeAccount()
	{
		$sql = Mysql::connect()->prepare("SELECT `stripe_acc` FROM `users`");
		$sql->execute();
		$stripe_acc = $sql->fetch()['stripe_acc'];

		if($stripe_acc == ""){
			$account = \Stripe\Account::create([
				'country' => 'br',
				'type'	  => 'standard'
			]);

			$account_links = \Stripe\AccountLink::create([
				'account' 	  => $account['id'],
				'refresh_url' => APP_URL.'/home',
				'return_url'  => APP_URL.'/home',
				'type'		  => 'account_onboarding'
			]);

			return $account_links;
		}else{
			// Mostrar saldo
			return true;
		}
	}
}
