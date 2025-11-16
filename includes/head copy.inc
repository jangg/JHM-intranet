<title><?= LOC_NAME ?></title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    <meta name="description" content="">
<meta name="author" content="ProHunter"> -->
<meta name="keywords" content="n">
<meta name="robots" content="noindex, nofollow">
<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host     = $_SERVER['HTTP_HOST'];
$rootUrl  = $protocol . $host;
// echo $rootUrl;   // bijv. https://mijnsite.nl
?>
<link rel="shortcut icon" type="image/x-icon" href="logos/favicon.ico"/>

<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= $rootUrl ?>/css/mystyle.css">

<!-- JS, Popper.js, and jQuery -->
<script   src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script   src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script   src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">       
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css' rel='stylesheet' type='text/css'> 
<link href='https://fonts.googleapis.com/css?family=Cousine' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">        
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-52110989-16"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-52110989-16');
</script>
