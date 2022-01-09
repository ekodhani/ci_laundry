<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<!-- font awesome -->
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

		<!-- custom style -->
		<link rel="stylesheet" href="<?= base_url('assets/css/style2.css'); ?>">

		<!-- favicon -->
		<link rel="shortcut icon" href="<?= base_url('assets/img/brand/W.png'); ?>" type="image/x-icon">

    <title><?= $title; ?></title>
  </head>
  <body>

	<!-- Section login  -->
	<div class="container">
		<section id="login" class="text-center row justify-content-center">
		<?= $this->session->flashdata('message'); ?>
		<h1 class="mb-5"><?= $title; ?></h1>
		<form action="" method="post" class="col-4">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" name="username" placeholder="username">
				<label for="floatingInput">Username</label>
			</div>
			<div class="form-floating mb-3">
				<input type="password" class="form-control" id="floatingPassword" name="password" placeholder="password">
				<label for="floatingPassword">Password</label>
			</div>

			<button type="submit" class="btn btn-light border mb-5">Login</button>
			
			<hr>
			<h1><i class="fas fa-hands-wash" style="font-size: 26px;"></i> <?= $title; ?></h1>
			<p>©2022 All Rights Reserved. <?= $title; ?>! Privacy and Terms</p>
		</form>
	</section>
	
	</div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>