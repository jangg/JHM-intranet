<?php
declare(strict_types=1);

require_once('config.php');
include_once('class/c_user.php');

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// PHP 7.3+: ini_set('session.cookie_samesite', 'Lax'); // of Strict

// Logout-ish: je deed dit al
unset($_SESSION['username'], $_SESSION['userid'], $_SESSION['logged_in']);

if (isset($_POST['vergeten'])) {
	header('Location: ./vergeten.php');
	exit();
}

/** CSRF token */
if (empty($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$foutidpw = false;

if (isset($_POST['aanmelden'])) {

	// CSRF check
	$postedToken = $_POST['csrf_token'] ?? '';
	if (!is_string($postedToken) || !hash_equals($_SESSION['csrf_token'], $postedToken)) {
		http_response_code(403);
		exit('Ongeldige sessie (CSRF). Vernieuw de pagina.');
	}

	$username = trim((string)($_POST['username'] ?? ''));
	$password = (string)($_POST['password'] ?? '');

	if ($username !== '' && $password !== '') {
		$user = new User('username', $username);

		if (!empty($user->id)) {
			// Let op: pas je User class aan zodat dit het hashveld is:
			// $user->password_hash
			$hash = (string)($user->password_hash ?? '');

			if ($hash !== '' && password_verify($password, $hash)) {

				// Optioneel: als hash verouderd is, herhashen
				if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
					$user->password_hash = password_hash($password, PASSWORD_DEFAULT);
					$user->updateToDB();
				}

				// Belangrijk: nieuw session id na login
				session_regenerate_id(true);

				$_SESSION['logged_in'] = true;
				$_SESSION['username']  = $username;
				$_SESSION['userid']    = (int)$user->id;

				// activity
				$datetime = new DateTime();
				$user->activity = $datetime->format('Y-m-d H:i:s');
				$user->updateToDB();
				session_regenerate_id(true);
				
				if ($user->mustChangePassword()) {
					header('Location: wijzwacht.php');
				} else {
					if (!isset($_SESSION['topicid'])) {
						header('Location: home.php');
					} else {
						header('Location: forum/overz_topic.php?id=' . (int)$_SESSION['topicid']);
						unset($_SESSION['topicid']);
					}
				}
				exit();
			}
		}
	}

	// Als je hier komt: fout
	$foutidpw = true;
}
?>
<!DOCTYPE html>
<html>
	<head>
	<?php include('includes/head.php'); ?>
	</head>
	<body class="container-fluid bodystyle">
		
		<div class="container">
			<div class="row mt-5 text-center">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<a href="index.php"><img src="logos/<?php echo LOC_LOGO;?>" alt="LogoJHM" class="img-fluid" style="width: 100%"></a><br/><br/><br/><br/>
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
					<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

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
				&copy <?php echo date("Y") . ' ' . LOC_NAME;?>
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
	</body>
<!-- Latest compiled and minified JavaScript -->
</html>