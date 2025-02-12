<?php
// error_log(basename($_SERVER['PHP_SELF']));
?>
<nav class="navbar navbar-expand-xl navbar-dark fixed-top bg-primary">
	<div class="container">
		<a href="/home.php"><span class="navbar-brand">JobHulpMaatje Zoetermeer Intranet</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'home.php') echo 'active'; ?>">
					<a class="nav-link" href="/home.php">Home</a>
				</li>
				<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'agenda.php') echo 'active'; ?>">
					<a class="nav-link" href="/agenda.php">Agenda</a>
				</li>				
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
					Overige info
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="/faces.php">Wie is wie?</a>
					<a class="dropdown-item" href="/nieuwsbrief.php">Nieuwsbrieven</a>
					<a class="dropdown-item" href="/jaarverslag.php">Jaarverslag 2021</a>
<!-- 					<a class="dropdown-item" href="/procedure.php">Workshops procedure</a>
					<a class="dropdown-item" href="/pages/bericht20210428_1.php">Verslag bestuursvergadering</a> -->

					<!-- <a class="dropdown-item" href="/pages/bericht20201001_1.php">Regels gebruik Forum</a> -->
				</div>
				</li>

				<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'overz_forum.php' || basename($_SERVER['PHP_SELF']) == 'overz_cat.php' || basename($_SERVER['PHP_SELF']) == 'overz_topic.php') echo 'active'; ?>">
					<?php
					if (!isset($curr_user) || $curr_user->authLevel() <= '2')
					echo '<a class="nav-link disabled" href="#">JHMZ forum</a>';
					else {
						if ($curr_user->authLevel() >= '3')
						echo '<a class="nav-link" href="/forum/overz_forum.php">JHMZ forum</a>';
					}
					?>

					
				</li>
				<li class="nav-item <?php if (substr(basename($_SERVER['PHP_SELF']), 7) == '/beheer') echo 'active'; ?>">
					<?php
					if (!isset($curr_user) || $curr_user->authLevel() <= '5')
					echo '<a class="nav-link disabled" href="#">de WAS</a>';
					else {
						if ($curr_user->authLevel() >= '6')
						echo '<a class="nav-link" href="/beheer/beheer.php">de WAS</a>';
					}
					?>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link" href="/logout.php">Log uit</a>
				</li> -->
			</ul>
			<!-- <div class="text-white"> -->
			<!-- <li class="nav-item">
				Ingelogd als: <?php if (isset($curr_user)) echo $curr_user->username; else echo '----';?>
			</div> -->
			<li class="navbar-nav dropdown">
				<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
					Ingelogd als: <?php if (isset($curr_user)) echo $curr_user->username; else echo '----';?>
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="/wijzwacht.php">Wijzig wachtwoord</a>
					<a class="dropdown-item"  href="/logout.php">Log uit</a>
				</div>
			</li>
		</div>
	</div>
</nav>