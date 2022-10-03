<?php 
	include('./vendor/autoload.php');
	session_start();
	$app = new Src\Application();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Marktplace - home</title>
    <meta charset="utf-8">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
  	<header class="p-3 text-bg-dark">
	    <div class="container">
	      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
	        <a href="<?= APP_URL ?>/home" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
	          <h3>Marktplace</h3>
	        </a>

	        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
	          <li><a href="<?= APP_URL ?>/home" class="nav-link px-2 text-secondary">Home</a></li>
	          <li><a href="#" class="nav-link px-2 text-white">Products</a></li>
	          <li><a href="#" class="nav-link px-2 text-white">Contact</a></li>
	          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
	        </ul>

	        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
	          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
	        </form>

	        <div class="text-end">
	          <?php if(!isset($_SESSION['login'])): ?>
	          	<a href="<?= APP_URL ?>/auth/login" class="btn btn-outline-light me-2">Login</a>
	          	<a href="<?= APP_URL ?>/auth/signup" class="btn btn-warning">Sign-up</a>
	          <?php else:?>
	          	<a href="<?= APP_URL ?>/createProduct" class="btn btn-primary">Cadastrar produto</a>
	          	<a href="?logout" class="btn btn-warning">logout</a>
	          <?php endif; ?>
	        </div>
	      </div>
	    </div>
  	</header>

    <?php
    	$app->run();
	?>
  </body>
</html>
