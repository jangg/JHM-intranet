<?php
require_once ('config.php');
include_once('class/c_user.php');

unset($_SESSION['user']);

if (isset($_POST['vergeten']))
{
	header('location:./vergeten.php');
	exit();
}

$foutidpw = TRUE;

if (isset($_POST['aanmelden']) && $_POST['username'] != '')
{
	$_POST['aanmelden'] = '';
	$user = new User('username', $_POST['username']);
 //	echo  $user;
	if ($user->id != NULL)
	{
		// if ($user->password == md5($_POST['password']))
		if ($user->password == $_POST['password'])
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
			{
				if (!isset($_SESSION['topicid']))
				{
					header('location:home.php');					
				} else 
				{
					header('location:forum/overz_topic.php?id=' . $_SESSION['topicid']);
					unset($_SESSION['topicid']);
				}
			}
			exit();
		}
	}
}
else $foutidpw = FALSE;
?>
<!DOCTYPE html>
<html>
	<head>
	<?php include('includes/head.inc'); ?>
	</head>
	<body class="container-fluid bodystyle">
		
		<div class="container">
			<div class="row mt-5 text-center">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<a href="index.php"><img src="logos/Logo_JobHulpMaatje_Zoetermeer.svg" alt="LogoJHMZoetermeer" class="img-fluid" style="width: 100%"></a><br/><br/><br/><br/>
				</div>
			</div>
		</div>		
		<div>
			<div class="row mt-5 text-center">
				<div class="col-lg-3"></div>
					<div class="col-lg-6">	
						<h3 class="display-4">INTRANET</h3>
					</div>
				<div class="col-lg-3"></div>
			</div>
			<div class="row">
				<div class="col-lg-4"></div>
				<div class="col-lg-4">
					<h5>Inloggen</h5>
				<form role="form" method="POST" action="index.php">
					<div class="form-groups">
						<label for="username">Gebruikersnaam</label>
						<input name="username" type="text" class="form-control  <?php if ($foutidpw) echo 'border-danger'; else echo '';?>" id="username" size="35">
					</div>
					<div class="form-groups">
						<label for="password">Wachtwoord</label>
						<input name="password" type="password" class="form-control  <?php if ($foutidpw) echo 'border-danger'; else echo '';?>" id="password" size="35">
					</div><br/>
					<button name="aanmelden" type="submit" class="btn btn-primary">Login</button>
					<button name="reset" type="submit" class="btn btn-secondary">Reset</button>
					<button name="vergeten" type="submit" class="btn btn-secondary">Wachtwoord vergeten?</button>
				</form>
				</div>
				<div class="col-lg-4"></div>
			</div>
			<div class="row footer">
				<div class="col-lg-3"></div>
				<div class="col-lg-6 text-center my-5">
				&copy <?php echo date("Y");?> JobHulpMaatje Zoetermeer
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
	</body>
<!-- Latest compiled and minified JavaScript -->
</html>