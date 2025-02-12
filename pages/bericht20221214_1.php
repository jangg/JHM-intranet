<?php
include_once('../config.php');
include_once('../class/c_user.php');
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

?>
<!DOCTYPE HTML>
<html lang="nl-NL">
	<head>
		<?php include('../includes/head.inc'); ?>			
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
			bold {
				color: red;
				font-style: italic;
				font-weight: bold;
			}

			
		</style>
	<!-- Custom styles for this template -->
		<link href="../css/jumbotron.css" rel="stylesheet" type='text/css'>
		<link href="../css/mystyle.css" rel="stylesheet" type='text/css'>
		<link href="https://fonts.googleapis.com/css2?family=Courier+Prime&family=Source+Serif+Pro&display=swap" rel="stylesheet">
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
	
<?php include('../includes/navbar.inc'); ?>
<div class="jumbotron">
	<div id="main">
		<div class="container verslag my-5">
			<h3 class="bluefont">14 december 2022</h3>
			<h1 class="text-black mb-2 bluefont">Gesprek met de wethouder</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
			<figure class="figure float-left" style="width: 100%; margin-right: 15px;">
			  <img src="../img/bouke-velzen-666x1000px.jpg" class="figure-img img-fluid" alt="azc groep">
			  <figcaption class="figure-caption">Wethouder Bouke Velzen</figcaption>
			 </figure>
			<h4>Positief gesprek met Wethouder Bouke Velzen op 14 december</h4>
			
			<p>Van JHM waren aanwezig Jan Waaijer en Peter Veld.</p>
			<p>De wethouder toonde zich bijzonder geïnteresseerd in het werk van JobHulpMaatje. 
			We hebben aangegeven op welke doelgroepen we ons feitelijk nu richten. Daarbij kwam aan de orde dat velen nog niet profiteren van de krappe arbeidsmarkt. Het herkennen en bereiken van deze mensen vergt een communicatieaanpak, waarin geprobeerd wordt zo dicht mogelijk bij deze personen te komen. Dat zal ook meer dan in het verleden moeten gebeuren door samenwerking met andere organisaties.</p> 
			<p>We hebben kunnen toelichten dat de partnerbijeenkomst in juni jl erg positief is verlopen en inmiddels ook al een eerste uitwerking heeft gekregen in de bijeenkomst over Intake. De belangrijkste actiepunten uit het gesprek over intake zijn dat aan gemeentekant de intake nogal ingewikkeld is met een domeintoets door de gemeente en daarna een intake door DBB. En dan is de intake in delen geknipt (de algemene intake, die voor 27 min en die voor asiel). En de maatschappelijke organisaties kunnen aan de voorkant nog veel beter investeren in de intake en zo hulpvragen bij de juiste organisaties te krijgen. Het spinnenweb van Piezo biedt daar aanknopingspunten voor. De wethouder begreep deze punten. Hij gaf aan bij een vervolg zo mogelijk aanwezig te willen zijn. </p>
			<p>De wethouder vroeg door op de samenwerking te DBB en gaf aan dat een positieve ontwikkeling te vinden.</p> 
			<p>Er werd ook gediscussieerd over het Stadsdiaconaat i.o. We waren het eens dat dit niet een verzameling losse delen zou moeten zijn, maar een meerwaarde zou moeten bieden door mensen die contact zoeken vanuit een breed perspectief benaderd worden. De wethouder was het ermee eens. Hij gaf wel aan, dat hij dit niet zomaar vanuit de gemeente wil sturen. Vanuit zijn achtergrond heeft hij veel sympathie voor het vrijwilligerswerk en dat moet ook de kans hebben zelf samen te werken en zelf keuzes te maken. </p>
			<p>N.a.v. de wens van JHM meer met de SEBO bedrijven te willen doen adviseerde de wethouder dit op te pakken samen met DBB (Maika van Veen), die de gemeentetaak bij SEBO ondersteunt.</p> 
			<p>De gemeente ondersteunt ook in 2023 het werk van JHM financieel.
			De wethouder gaf aan veel opgeschreven te hebben en dat te laten bezinken. Hij staat open voor verder gesprek.</p>


		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
