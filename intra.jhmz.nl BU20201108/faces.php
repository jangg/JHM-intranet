<?php
include_once('config.php');
include_once('class/c_person_coll.php');
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


$arr1 = '';
$arr2 = array (	array (0 => 'person.achternaam', 1 => 'ASC'));

$personenColl = new Person_coll ($arr1, $arr2);

$nr_personen = count($personenColl->personColl);
$nr_perrow = 4;
$nr_rest = (floor($nr_personen / $nr_perrow) + 1) * $nr_perrow - $nr_personen;
if ($nr_rest == $nr_perrow)
	$nr_rest = 0;
$fotopath = 'fotoos_person/';
?>

<html>
	<head>
		<?php include('includes/head.inc'); ?>				
	</head>
<body style="background-color: #dddddd;">
	<?php include('includes/navbar.inc'); ?>
	<div class="container">
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3 mb-3 mx-0 px-0">
				<h1 class="mx-auto text-uppercase">wie is wie ?</h1>
			</div>
		</div>
		<div class="card-deck" style="font-size: 13px;">
			<?php 
				$j = 0;
				foreach ($personenColl->personColl as $person) {
					if ($person->picfile != '')
						$picture = $fotopath . $person->picfile;
						else $picture = 'img/unknown.png';
					if ($person->emailadres == '')
						$email = '--';	else $email = $person->emailadres;	
					if ($person->telefoonnr == '')
						$telefoon = '--'; else $telefoon = $person->telefoonnr;
					if (substr($person->telefoonnr, 0, 3) == '06-')
						$whatsapp = '<a href="https://wa.me/316' . substr($person->telefoonnr, 3, 8) . '">WhatsApp ' . $person->voornaam . '</a>';
						else $whatsapp = '--';		
						if ($person->link_linkedin == '')
						$linkedin = '--'; else {
							$link = explode('/', $person->link_linkedin);
							$linkedin = '<a href="' . $person->link_linkedin . '">' . end($link) . '</a>';
						}
					echo '		
					<div class="card bg-light m-1 m-lg-2 shadow-sm">
						<img class="card-img-top" src="' . $picture . '" alt="">
						<div class="card-body m-0 px-1 py-2 px-lg-2">
							<h5 class="card-title">' . $person->voornaam . ' ' . $person->tussenvoegsels . ' ' . $person->achternaam .'</h5>
							<h6 class="card-subtitle text-muted">' . $person->functie . '</h6>
							<p class="card-text mt-2">' . $person->omschrijving . '</p>
						</div>
						<ul class="list-group m-1 p-0" style="list-style-type: none;">
						    <li class="m-0 p-1"><i class="fa fa-envelope"></i><a href="mailto:' . $email . '">&nbsp&nbsp' . $email . '</a></li>
						    <li class="m-0 p-1"><i class="fa fa-phone"></i>&nbsp&nbsp' . $telefoon . '</li>
							<li class="m-0 p-1"><img src="logos/WhatsApp_Logo_3.png" width="16">&nbsp&nbsp' . $whatsapp . '</li>
							<li class="m-0 p-1"><img src="logos/linkedin.png" width="16">&nbsp&nbsp' . $linkedin . '</li>
						</ul>
						<div class="card-footer m-0 p-1 text-center ">
							<small>Laatst bijgewerkt op ' . $person->datummod . '</small>
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
		<div class="p-5">
		</div>
	</div>
	<?php include('includes/footer.inc'); ?>
	</body>
</html>