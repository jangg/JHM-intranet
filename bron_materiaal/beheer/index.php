<?php
require_once ('config.php');
include_once('classes/c_user.php');

unset($_SESSION['user']);

if (isset($_POST['vergeten']))
{
	header('location:vergeten.php');
}

if (isset($_POST['aanmelden']))
{
	$user = new User('username', $_POST['username']);
// 	echo  $user;
	if ($user->id != NULL)
	{
		if ($user->password == md5($_POST['password']))
		{
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['userid'] = $user->id;
		    $datetime = new DateTime();
			$user->activity = $datetime->format('Y\-m\-d\ H:i:s');
			$user->updateToDB();
			if ($user->mustChangePassword())
				header('location:wijzwacht.php');
			else
				header('location:overz_aanvr.php');
		}
	}
}


	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>JHM Zoetermeer Intranet</title>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href='http://fonts.googleapis.com/css?family=Cousine' rel='stylesheet' type='text/css'>		

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">	
		<!-- CSS only -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		
		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		
		<link href="css/beheer_style.css" rel="stylesheet" type="text/css" /> 
	</head>
	<body>
		<div class="container">
			<div class="row header">
				<div class="col-sm-3"></div>
				<div class="col-sm-6" style="margin: 20px auto; text-align: center;">
					<a href="index.php"><img src="img/LogoJHMZoetermeer.jpg" alt="LogoJHMZoetermeer" width="223"></a><br/><br/><br/><br/>
					<h3>JHM Zoetermeer intra</h3>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h5>Inloggen</h5>
				<form role="form" method="POST" action="index.php">
					<div class="form-groups">
						<label for="username">Gebruikersnaam</label>
						<input name="username" type="text" class="form-control" id="username" size="35">
					</div>
					<div class="form-groups">
						<label for="password">Wachtwoord</label>
						<input name="password" type="password" class="form-control" id="password" size="35">
					</div><br/>
					<button name="aanmelden" type="submit" class="btn btn-primary">Login</button>
					<button name="reset" type="submit" class="btn btn-secondary">Reset</button>
					<button name="vergeten" type="submit" class="btn btn-secondary">Wachtwoord vergeten?</button>
				</form>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row footer">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
				&copy 2020 JobHulpMaatje Zoetermeer
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</body>
<!-- Latest compiled and minified JavaScript -->
</html>