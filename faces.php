<?php
include_once('config.php');
include_once('class/c_maatje_coll.php');
include_once('class/c_user.php');


/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:index.php');
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

if (!isset($_POST['selection']))
{
	$arr1 = '';
	// $arr1 = array (array (0 => 'person.type', 1 => 'all'));
	$selection = 'all';
}
else
{
	switch ($_POST['selection'])
	{
		case 'all':
			$arr1 = '';
			$selection = 'all';
			break;
		case 'mtj':
			$arr1 = array (array (0 => 'person.type', 1 => 'mtj'));
			$selection = 'mtj';
			break;
		case 'ext':
			$arr1 = array (array (0 => 'person.type', 1 => 'ext'));
			$selection = 'ext';
			break;
		default:
	}
}
$arr2 = array (	array (0 => 'person.achternaam', 1 => 'ASC'));

$maatjesColl = new Maatje_coll ($arr1, $arr2);

$nr_maatjes = count($maatjesColl->maatjeColl);
$nr_perrow = 4;
$nr_rest = (floor($nr_maatjes / $nr_perrow) + 1) * $nr_perrow - $nr_maatjes;
if ($nr_rest == $nr_perrow)
	$nr_rest = 0;
$fotopath = 'fotoos_person/';
?>

<html>
	<head>
		<?php include('includes/head.inc'); ?>
	</head>
<body class="bodystyle">
	
	<?php include('includes/navbar.inc'); ?>
	<div class="container">
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3 mb-3 mx-0 px-0">
				<div class="col-md-5 p-0"></div>
				<div class="col-md-4 p-0">
					<h1 class="mx-auto text-uppercase">wie is wie ?</h1>
				</div>
				<div class="col-md-1 p-0 form-group text-right">
					<label for="sel1" class="col-form-label">Toon&nbsp&nbsp</label>
				</div>
				<div class="col-md-2 p-0">
					<form method="POST" action="faces.php" novalidate>
					<select name="selection" class="form-control" id="sel1" onchange="this.form.submit()">
						<option value="mtj" <?php if($selection == 'mtj') echo 'selected'; ?>>maatjes</option>
						<option value="ext" <?php if($selection == 'ext') echo 'selected'; ?>>externen</option>
						<option value="all" <?php if($selection == 'all') echo 'selected'; ?>>iedereen</option>
					</select>
					</form>
				</div>
			</div>
		</div>
		<div class="card-deck" style="font-size: 13px;">
			<?php 
				$j = 0;
				foreach ($maatjesColl->maatjeColl as $maatje) {
					$user = new User ('id_person', $maatje->id_person);
					$activity = Tools::ConvertTS($user->activity);
					
					if ($maatje->picfile != '')
						$picture = $fotopath . $maatje->picfile;
						else $picture = 'img_fixed/unknown.png';
					if ($maatje->emailadres == '')
						$email = '--';	else $email = $maatje->emailadres;	
					if ($maatje->telefoonnr == '')
						$telefoon = '--'; else $telefoon = $maatje->telefoonnr;
					if (substr($maatje->telefoonnr, 0, 3) == '06-')
						$whatsapp = '<a href="https://wa.me/316' . substr($maatje->telefoonnr, 3, 8) . '">WhatsApp ' . $maatje->voornaam . '</a>';
						else $whatsapp = '--';		
						if ($maatje->link_linkedin == '')
						$linkedin = '--'; else {
							$link = explode('/', $maatje->link_linkedin);
							$linkedin = '<a href="' . $maatje->link_linkedin . '">' . $maatje->voornaam . $maatje->tussenvoegsels . $maatje->achternaam . '</a>';
						}
					echo '		
					<div class="card bg-light m-1 m-lg-2 shadow-sm">
						<img class="card-img-top" src="' . $picture . '" alt="">
						<div class="card-body m-0 px-1 py-2 px-lg-2">
							<h5 class="card-title">' . $maatje->voornaam . ' ' . $maatje->tussenvoegsels . ' ' . $maatje->achternaam .'</h5>
							<h6 class="card-subtitle text-muted">' . $maatje->functie . '</h6>
							<p class="card-text mt-2">' . $maatje->omschrijving . '</p>
						</div>
						<ul class="list-group m-1 p-0" style="list-style-type: none;">
						    <li class="m-0 p-1"><i class="fa fa-envelope"></i><a href="mailto:' . $email . '">&nbsp&nbsp' . $email . '</a></li>
						    <li class="m-0 p-1"><i class="fa fa-phone"></i>&nbsp&nbsp' . $telefoon . '</li>
							<li class="m-0 p-1"><img src="logos/WhatsApp_Logo_3.png" width="16">&nbsp&nbsp' . $whatsapp . '</li>
							<li class="m-0 p-1"><img src="logos/linkedin.png" width="16">&nbsp&nbsp' . $linkedin . '</li>
						</ul>
						<div class="card-footer m-0 p-1 text-center ">
							<small>Laatst actief op ' . $activity . 'h' . '</small>
						</div>
					</div>
					';
					$j++;
					if ($j > ($nr_perrow -1)) {
						$j = 0;
						echo '</div><div class="card-deck" style="font-size: 13px;">';
					}		
				}
				for ($i = 0; $i < ($nr_rest); $i++) {
					echo '		
					<div class="card bg-light m-1 m-lg-2 shadow-sm">
					<img class="card-img-top" src="" alt="">
					<div class="card-body">
					<h5 class="card-title"></h5>
					<h6 class="card-subtitle mb-2 text-muted"></h6>
					<p class="card-text"></p>
					<p><a href="mailto:"></a></p>
					</div>
					<div class="card-footer"><small class="text-muted"></small></div>
					</div>
					';				
				}
				echo '</div>';
			?>
		</div>
	</div>
	<?php include('includes/footer.inc'); ?>
	</body>
</html>