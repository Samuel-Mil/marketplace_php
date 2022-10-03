<?php
	foreach($products as $key => $product){
		$user = $model::getUser($product['user_id']);
		$stripe = $model::setStripeSession($product);
		echo '
			<div class="container">
				<h1>'.$product['name'].'</h1>
				<p>'.$product['description'].'</p>
				<h3>R$'.$product['price'].'</h3>
				<strong>'.$user.'</strong>
				<a href="'.$stripe['url'].'" class="btn btn-primary">Buy now</a>
				<hr/>
			</div>
		';
	}
?>
