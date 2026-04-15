<?php
/***************************************
*****
***** Autorisatie levels worden hier bepaald
***** 0 = Alleen lezen, geen Forum
***** 1 = Alleen lezen, ook Forum lezen
***** 2 = Lezen + Forum lezen/schrijven
***** 3 = 2
***** 4 = 3 + Redactie 
***** 5 = 3 + WAS
***** 6 = 3 + Redactie & WAS
***** 7 = 6
***** 8 = 6
***** 9 = 6
*******************************************/

$level			= isset($curr_user) ? (int)$curr_user->authLevel() : 0;
$canForumRead 	= $level >= 1;
$canForumWrite 	= $level >= 2;
$canRedactie 	= $level === 4 || $level >= 6;
$canWas      	= $level >= 5;
$canAll 		= $level === 9;
?>
<nav class="navbar navbar-expand-xl navbar-dark fixed-top bg-primary">
	<div class="container">
		<a href="/home.php"><span class="navbar-brand"><?php echo LOC_NAME; ?> Intranet</span></a>
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
						<a class="dropdown-item" target="_new" href="<?php echo LOC_WEBSITE_PUB ?>">Publieke website</a>
					</div>
				</li>

				<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'overz_forum.php' || basename($_SERVER['PHP_SELF']) == 'overz_cat.php' || basename($_SERVER['PHP_SELF']) == 'overz_topic.php') echo 'active'; ?>">
					<a class="nav-link <?= $canForumRead ? '' : 'disabled' ?>" href="<?= $canForumRead ? '/forum/overz_forum.php' : '#' ?>">Forum</a>
				</li>
				
				
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Beheer</a>
					<div class="dropdown-menu">
					<a class="dropdown-item <?= $canRedactie ? '' : 'disabled' ?>"
					   href="<?= $canRedactie ? '/beheerred/beheer.php' : '#' ?>"
					   <?= $canRedactie ? '' : 'aria-disabled="true"' ?>>Redactie</a>
					
					<a class="dropdown-item <?= $canWas ? '' : 'disabled' ?>"
					   href="<?= $canWas ? '/beheerwas/beheer.php' : '#' ?>"
					   <?= $canWas ? '' : 'aria-disabled="true"' ?>>de WAS</a>					
				   </div>
				</li>
			</ul>
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