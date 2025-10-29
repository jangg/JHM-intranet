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
$arr1 = array (	array (0 => 'person.type', 1 => 'mtj'));
// $arr1 = NULL;
$arr2 = array (	array (0 => 'voornaam', 1 => 'ASC'));

$userColl = new User_coll ($arr1, $arr2);

$html = '';
$i = 0;
foreach ($userColl->userColl as $user) 
{
	
	$presentInd = $user->presentInd;
	$htmlextra = '';
	//echo $presentInd;
	if ($curr_user->username == $user->username  || $curr_user->beheerind > 6)
	{
		$first_disabled = '';
		$htmlextra = ' id="presence_switch" value="' . $user->id . '" ';
	}
	else
		$first_disabled = 'disabled';

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
			$first_text = 'JA';
			$second_text = '&nbsp;';
		}
	}
	$i++;
	$html .='
		<tr>
			<td>' . $i . '</td>
			<td>' . $user->voornaam . ' ' . $user->tussenvoegsels . ' ' . $user->achternaam . '</td>
			<td>
				<label>komt naar de maatjesavond&nbsp;&nbsp;</label>
				<input class="usersel" type="checkbox" name="userid"' . 
					$htmlextra . ' data-toggle="toggle" data-size="sm" data-on="' . 
					$first_text . '" data-off="' . 
					$second_text . '" data-onstyle="success" data-offstyle="secondary" ' .
					$first_but . ' ' . 
					$first_disabled . ' data-width="80px" ' . 
					'data-userid="' . $user->id . '">
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
		<!-- <link href="../css/mystyle.css" rel="stylesheet" type='text/css'> -->
		<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
		<script>
		$(document).ready(function(){
			$('.usersel').on('change', function() 
			{
				const userid = $(this).data('userid');
				$.ajax(
				{
					url: 'proces_presence.php',
					type: 'POST',
					data:	{ userid: userid,
							},
					success: function(response)
					{
					}
				});
			});
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
 
<body class="bodystyle">
<?php include('../includes/navbar.inc'); ?>
<div class="jumbotron">
	<div id="main">
	<div class="container my-5" >
		<h3 class="bluefont">28 augustus 2025</h3>
		<h1 class="text-black mb-5 bluefont">Deelnamelijst Maatjesavond</h1>
		<p>Op woensdagavond 10 september 2025 vindt de volgende maatjesavond plaats. Deze vindt plaats in het Forum van het stadhuis.</p>
		<p>Nu aanmelden of afmelden is belangrijk en simpel. De knop is grijs als je nog geen keuze hebt gemaakt. Als de schuifknop 1 x aanklikt wordt het 'ja' en geef je aan dat je komt. Als je de knop 2 x aanklikt wordt het, na refresh, 'nee' en geef je dus aan dat je niet komt.</p>
		<p><strong>Schrijf je hier in en kom ook op 11 juni. </strong></p>
		<table class="table table-sm">
			<thead>
				<tr>
				<th></th>
				<th>Genodigde</th>
				<th>Response</th>
				</tr>
			</thead>
			<tbody>
				<!-- <form method="POST" action="<?php // echo $_SERVER['PHP_SELF'];?>" id="aanmelding" novalidate> -->
				<?php echo $html; ?>
				<!-- </form> -->
			</tbody>
		</table>		
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
