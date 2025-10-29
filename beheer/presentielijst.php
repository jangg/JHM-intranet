<?php
include_once('../config.php');
include_once('../class/c_user_coll.php');
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
$arr2 = array (	array (0 => 'voornaam', 1 => 'ASC'));

$userColl = new User_coll ($arr1, $arr2);

$html = '';
foreach ($userColl->userColl as $user) 
{
	
	$presentInd = $user->presentInd;
	// echo $presentInd;
	if ($curr_user->username != $user->username)
	{
		if ($user->beheerind > 6)
			$first_disabled = '';
			else
			$first_disabled = 'disabled';
	}
	else
	{
		$first_disabled = 'disabled';
	}
	
	if ($presentInd == 'j')
	{
		$first_but = 'checked';
		$first_text = 'JA';
		$second_text = 'NEE';
	} else
	{
		if ($presentInd == 'n')
		{
			$first_but = '';
			$first_text = 'JA';
			$second_text = 'NEE';
		} else 
		{
			$first_but = '';
			$first_text = '&nbsp;';
			$second_text = '&nbsp;';
		}
	}

	$html .='
	<tr>
			<td>' . $user->voornaam . ' ' . $user->tussenvoegsels . ' ' . $user->achternaam . '</td>
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
		<?php $date = new DateTime();
			$datum = $date->format("j F Y"); ?>
		<h3 class="bluefont"><?php echo $datum; ?></h3>
		<h1 class="text-black mb-5 bluefont">Aanwezigheidslijst 14 december</h1>
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
