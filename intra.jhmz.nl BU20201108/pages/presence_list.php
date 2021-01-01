<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_user_coll.php');
include_once('..//class/c_person.php');
/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}
if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}
/**********************/
$arr1 = '';
$arr2 = array (	array (0 => 'user.username', 1 => 'ASC'));

$userColl = new User_coll ($arr1, $arr2);

$html = '';
foreach ($userColl->userColl as $user) {
	
	if ($curr_user->username != $user->username)
		$first_disabled = 'disabled';
		else
		{
			$first_disabled = '';
			$user->beheerind = 'n';
		}	
	
	switch ($user->beheerind)
	{	case 'j':
			$first_but = 'checked';
			$first_text = 'JA';
			$second_text = 'NEE';
			break;
		case 'n':
			$first_but = '';
			$first_text = 'JA';
			$second_text = 'NEE';
			break;
		case '':
			$first_but = '';
			$first_text = '&nbsp;';
			$second_text = '&nbsp;';
			break;

		default:				
			$first_but = '';
			$first_disabled = '';

	}
	$person = new Person('id', $user->id_person);
	$html .='
	<tr>
			<td>' . $person->voornaam . ' ' . $person->tussenvoegsels . ' ' . $person->achternaam . '</td>
			<td>
				<label>komt naar de meeting&nbsp;&nbsp;</label>
				<input type="checkbox" data-toggle="toggle" data-size="sm" data-on="' . $first_text . '" data-off="' . $second_text . '" data-onstyle="success" data-offstyle="secondary" ' .
				$first_but . ' ' . $first_disabled . ' data-width="80px">
			</td>
		</tr>
	
	';
}



?>
<!DOCTYPE HTML>
<html lang="nl-NL">
	<head>
		<?php include('../includes/head.inc'); ?>			
	<!-- Custom styles for this template -->
		<link href="../css/jumbotron.css" rel="stylesheet" type='text/css'>
		<link href="../css/mystyle.css" rel="stylesheet" type='text/css'>
		<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
		<script>
		$(document).ready(function(){
		});		
		</script>
		<style>
					.bluefont {
						color: #304280;
						font-weight: 300;
					}
					.bg-jhmz {
						background-color: #eeeeee;
					}
					.errormessage {
						color: red;
					}
				</style>
			</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
<?php include('../includes/navbar.inc'); ?>
<div class="jumbotron">
	<div id="main">
	<div class="container my-5" >
		<h3 class="bluefont">3 oktober 2020</h3>
		<h1 class="text-black mb-5 bluefont">Aanwezigheidslijst voor de meeting van .....</h1>
		<p>Op ... wordt de maatjesavond georganiseerd. Dit is de lijst met genodigden en hun presentie:</p>	
		<table class="table table-sm">
		<thead>
			<tr>
			<th>Genodigde</th>
			<th>Response</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $html; ?>
		</tbody>
		</table>
		
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
