<?php
include_once('config.php');
// include_once('class/c_user.php');
// include_once('class/c_agendaitem_coll.php');
// include_once('class/c_maatje_coll.php');
include_once('class/c_jobgroup_coll.php');

/**********************/
function jobgroupHTML ($agendaitem) 
{
    $agenda_html = '';
    $datum = new DateTimeImmutable($agendaitem->datum);
    if ($agendaitem->begintijd != '')
    {
      $begin = new DateTimeImmutable($agendaitem->begintijd);
      $begintijd = $begin->format("G") . ':' . $begin->format("i");
    }
    else
      $begintijd = '';
    if ($agendaitem->eindtijd != '')
    {
      $eind = new DateTimeImmutable($agendaitem->eindtijd);
      $eindtijd = $eind->format("G") . ':' . $eind->format("i");
    }
    else
      $eindtijd = '';
    
    $agenda_html .=
    '<div class="card bg-light mb-4">
    <!-- <img src="..." class="card-img-top" alt="..."> -->
      <div class="card-header jg-header text-light">JobGroup ' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '</div>
      <div class="card-header text-dark">' . $agendaitem->titel . 
      '</div>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text mx-3 text-dark">' . nl2br($agendaitem->omschrijving) .
     '<table class="table">
        <tbody>
        <tr><td><i class="far fa-map-marker-alt mx-3"></i></td><td>Locatie</td><td>' . $agendaitem->locatie . '</td></tr>
        <tr><td><i class="far fa-calendar-alt mx-3"></i></td><td>Startdatum</td><td>' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '</td></tr>
        <tr><td><i class="far fa-clock mx-3"></i></td><td>Begin- en eindtijd</td><td>' . $begintijd . 'h - ' . $eindtijd . 'h</td></tr>
        <tr><td><i class="far fa-hashtag mx-3"></i></td><td>Aantal sessies</td><td>' . $agendaitem->freefld1 . '</td></tr>
        <tr><td><i class="far fa-user mx-3"></i></td><td>Contactpersoon</td><td>' . $agendaitem->freefld2 . '</td></tr>
        <tr><td><i class="far fa-envelope mx-3"></i></td><td>Vragen?</td><td>' . $agendaitem->freefld3 . '</td></tr>
        </tbody>
     </table>
      <div class="card-footer mt-4">
        <a href="aanmelden.php"><span class="btn btn-primary mt-1">Aanmelden bij JobHulpMaatje</span></a>
      </div>
      
    </div>
    </div>';
    return $agenda_html;
      
}

function balieHTML ($agendaitem) 
{
    $agenda_html = '';
    $datum = new DateTimeImmutable($agendaitem->datum);
    if ($agendaitem->begintijd != '')
    {
      $begin = new DateTimeImmutable($agendaitem->begintijd);
      $begintijd = $begin->format("G") . ':' . $begin->format("i");
    }
    else
      $begintijd = '';
    if ($agendaitem->eindtijd != '')
    {
      $eind = new DateTimeImmutable($agendaitem->eindtijd);
      $eindtijd = $eind->format("G") . ':' . $eind->format("i");
    }
    else
      $eindtijd = '';
    
    $agenda_html .=
    '<div class="card bg-light mb-4">
      <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-header ba-header text-light">Inloop spreekuur ' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '</div>
        <div class="card-header text-dark">' . $agendaitem->titel . 
        '</div>
      <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text mx-3 text-dark">' . nl2br($agendaitem->omschrijving) .
        '<table class="table">
        <tbody>
        <tr><td><i class="far fa-map-marker-alt mx-3"></i></td><td>Locatie</td><td>' . $agendaitem->locatie . '</td></tr>
        <tr><td><i class="far fa-calendar-alt mx-3"></i></td><td>Datum</td><td>' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '</td></tr>
        <tr><td><i class="far fa-clock mx-3"></i></td><td>Begin- en eindtijd</td><td>' . $begintijd . 'h - ' . $eindtijd . 'h</td></tr>
        <tr><td><i class="far fa-user mx-3"></i></td><td>Contactpersoon</td><td>' . $agendaitem->freefld1 . '</td></tr>
        <tr><td><i class="far fa-envelope mx-3"></i></td><td>Vragen?</td><td>' . $agendaitem->freefld2 . '</td></tr>
        </tbody>
     </table>
    </div>
    </div>';
    return $agenda_html;
      
}

function workshopHTML ($agendaitem) 
{
    $agenda_html = '';
    $datum = new DateTimeImmutable($agendaitem->datum);
    if ($agendaitem->begintijd != '')
    {
      $begin = new DateTimeImmutable($agendaitem->begintijd);
      $begintijd = $begin->format("G") . ':' . $begin->format("i");
    }
    else
      $begintijd = '';
    if ($agendaitem->eindtijd != '')
    {
      $eind = new DateTimeImmutable($agendaitem->eindtijd);
      $eindtijd = $eind->format("G") . ':' . $eind->format("i");
    }
    else
      $eindtijd = '';
    
   /* eerst volgt de opmaak van de kop van het agenda item */ 
    $agenda_html .= '
      <div class="card bg-light mb-4">
        <div class="card-header ws-header text-dark">Workshop ' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '
        </div>
        <div class="card-header text-dark">' . $agendaitem->titel . '
        </div>
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text mx-3 text-dark">' . nl2br($agendaitem->omschrijving) . '
          <div class="row">';
        
    /* test of er een bestaand plaatje bij moet, zo ja dan die eerst erbij zetten, anders weglaten */    
    if ( $agendaitem->freefld4 <> '' && file_exists('newsimages/' . $agendaitem->freefld4))
    {
      $agenda_html .= '
        <div class="col-md-3">
          <div class="text-center"><img src="newsimages/' . $agendaitem->freefld4 . '" class="m-0 img-fluid" /></div>
        </div>
        <div class="col-md-9">
      ';
    }  else 
    {
      $agenda_html .= '
        <div class="col-md-12">';
    }
    
    /* dan nu de agenda gegevens bijvoegen */
    $agenda_html .= '
        <table class="table">
          <tbody>
            <tr>
              <td><i class="far fa-map-marker-alt mx-3"></i></td>
              <td>Locatie</td>
              <td>' . $agendaitem->locatie . '</td>
            </tr>
            <tr>
              <td><i class="far fa-calendar-alt mx-3"></i></td>
              <td>Datum</td>
              <td>' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '</td>
            </tr>
            <tr>
              <td><i class="far fa-clock mx-3"></i></td>
              <td>Begin- en eindtijd</td>
              <td>' . $begintijd . 'h - ' . $eindtijd . 'h</td>
            </tr>
            <tr>
              <td><i class="far fa-user mx-3"></i></td>
              <td>Contactpersoon</td>
              <td>' . $agendaitem->freefld1 . '</td>
            </tr>
            <tr>
              <td><i class="far fa-envelope mx-3"></i></td>
              <td>Vragen?</td>
              <td>' . $agendaitem->freefld2 . '</td>
            </tr>
          </tbody>
        </table>
      </div> <!-- einde col -->
      </div> <!-- einde row -->
      <div class="card-footer mt-4">
        <a href="aanmelden.php"><span class="btn btn-primary mt-1">Aanmelden bij JobHulpMaatje</span></a>
      </div>      
    </div> <!-- einde card-body -->
    </div> <!-- einde card -->';
    return $agenda_html;
      
}

function meetingHTML ($agendaitem) 
{
    $agenda_html = '';
    $datum = new DateTimeImmutable($agendaitem->datum);
    if ($agendaitem->begintijd != '')
    {
      $begin = new DateTimeImmutable($agendaitem->begintijd);
      $begintijd = $begin->format("G") . ':' . $begin->format("i");
    }
    else
      $begintijd = '';
    if ($agendaitem->eindtijd != '')
    {
      $eind = new DateTimeImmutable($agendaitem->eindtijd);
      $eindtijd = $eind->format("G") . ':' . $eind->format("i");
    }
    else
      $eindtijd = '';
    
    $agenda_html .=
    '<div class="card bg-light mb-4">
      <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-header mt-header text-light">Bijeenkomst ' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '</div>
        <div class="card-header text-dark">' . $agendaitem->titel . 
        '</div>
      <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text mx-3 text-dark">' . nl2br($agendaitem->omschrijving) .
        '<table class="table">
        <tbody>
        <tr><td><i class="far fa-map-marker-alt mx-3"></i></td><td>Locatie</td><td>' . $agendaitem->locatie . '</td></tr>
        <tr><td><i class="far fa-calendar-alt mx-3"></i></td><td>Startdatum</td><td>' . strftime('%A %e %B %Y', $datum->getTimestamp()) . '</td></tr>
        <tr><td><i class="far fa-clock mx-3"></i></td><td>Begin- en eindtijd</td><td>' . $begintijd . 'h - ' . $eindtijd . 'h</td></tr>
        <tr><td><i class="far fa-user mx-3"></i></td><td>Contactpersoon</td><td>' . $agendaitem->freefld1 . '</td></tr>
        <tr><td><i class="far fa-envelope mx-3"></i></td><td>Vragen?</td><td>' . $agendaitem->freefld2 . '</td></tr>
        </tbody>
     </table>
      <!-- <div class="card-footer mt-4">
        <a href="aanmelden.php"><span class="btn btn-primary mt-1">Aanmelden bij JobHulpMaatje</span></a>
      </div> -->
      
    </div>
    </div>';
    return $agenda_html;
      
}

$date_now = date("Y-m-d");
$today = new DateTimeImmutable($date_now);
$agenda = [];

/* eerste alle jobgroups ophalen */
$jobgroups = new Jobgroup_coll ();
$agenda = array_merge($agenda, $jobgroups->jobgroupsAgenda());

/* dan alle workshops ophalen */
$arr1 = array (array (0 => 'agendaitem.type', 1 => 'wksp'));
$arr2 = array (array (0 => 'agendaitem.datum', 1 => 'ASC'), array (0 => 'agendaitem.begintijd', 1 => 'ASC'));
$workshops = new Agendaitem_coll ($arr1, $arr2);
/* dan alle meetings ophalen */
$arr1 = array (array (0 => 'agendaitem.type', 1 => 'mtng'));
$arr2 = array (array (0 => 'agendaitem.datum', 1 => 'ASC'), array (0 => 'agendaitem.begintijd', 1 => 'ASC'));
$meetings = new Agendaitem_coll ($arr1, $arr2);
/* dan alle balietijden ophalen */
$arr1 = array (array (0 => 'agendaitem.type', 1 => 'bali'));
$arr2 = array (array (0 => 'agendaitem.datum', 1 => 'ASC'), array (0 => 'agendaitem.begintijd', 1 => 'ASC'));
$balies = new Agendaitem_coll ($arr1, $arr2);

$allAgendaItemColl = array_merge($workshops->agendaitemColl , $meetings->agendaitemColl );
$allAgendaItemColl = array_merge($allAgendaItemColl , $balies->agendaitemColl );

/* Bepaal welke items op de externe agenda moeten worden geplaatst
Als: publicatie medium = 1 (extern) of 3 (intern en extern)
  en: datum item >= vandaag
*/

$itemAgenda = array();
foreach ($allAgendaItemColl as $item) 
{
  $itemDatum = new DateTimeImmutable($item->datum);
  if ($itemDatum >= $today && ($item->publmed == '1' || $item->publmed == '3'))
      $itemAgenda[] = $item;
}

$agenda = array_merge($agenda, $itemAgenda);

usort($agenda, function($a, $b)
 {
   /* sorteren op datum + begintijd */
   $akey = $a->datum . $a->begintijd;
   $bkey = $b->datum . $b->begintijd;
   if ($akey == $bkey)
     return (0);
   return (($akey < $bkey) ? -1 : 1);
 });


$agenda_html = '';
$maand = '';

foreach ($agenda as $agendaitem)
{
  $datum = new DateTimeImmutable($agendaitem->datum);
  if ($maand != $datum->format("m"))
  {
    if ($maand != '')
    {
      $agenda_html .=
      '</div></div>';
    }
    $maand = $datum->format('m');
    $agenda_html .=
    '<div class="row py-4" style="border-bottom: 6px solid #304280; text-align: left;">
    <div class="col">
    <p class="mb-4 text-dark display-3">' . strftime('%B', $datum->getTimestamp()) . ' ' . strftime('%Y', $datum->getTimestamp()) .'</p>';
  }
  switch ($agendaitem->type) {
    case 'jbgp':
      $agenda_html .= jobgroupHTML($agendaitem);
      break;
    case 'wksp':
      $agenda_html .= workshopHTML($agendaitem);
      break;
    case 'mtng':
      $agenda_html .= meetingHTML($agendaitem);
      break;
    case 'bali':
      $agenda_html .= balieHTML($agendaitem);
      break;
    default:
  }
}


?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
  <?php include_once ('includes/head.inc'); ?>
  <link href="/assets/css/style_agenda.css" rel="stylesheet">
  <!-- cookiealert styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">
  <!-- <link href="assets/css/form_main.css" rel="stylesheet" media="all"> -->
    
  <script>
    $(document).ready(function(){
      $('#a_agenda').addClass('active');
      });
  </script>
</head>

<body>
  <?php include_once ('includes/header.inc'); ?> 
  
  <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center" style="height: 30vh;">
      <div id="overlay"></div>
      <div class="container" data-aos="zoom-out" data-aos-delay="100" style="z-index: 3;">
        <h1 class="col-lg-12 d-none d-xl-block my-4" style="font-size: 6em;">Agenda</span></h1>
        <h1 class="col-lg-12 d-none d-xl-block my-4" style="font-size: 3em;">Welkom bij <span>JobHulpMaatje Zoetermeer</span></h1>
        <h1 class="col-lg-12 d-xl-none my-1" style="font-size: 3em;">Agenda</span></h1>
        <h1 class="col-lg-12 d-xl-none my-1" style="font-size: 1.5em;">Welkom bij <span>JobHulpMaatje Zoetermeer</span></h1>
        <!-- <h2 class="my-5">Als je op zoek bent naar werk en je kunt wat hulp gebruiken</h2> -->
      </div>
     </section><!-- End Hero -->
  
  
  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2 class="text-dark"></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Agenda</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
      
    <!-- ======= Agenda Section ======= -->
    <section id="agenda" style="padding-top: 40px;">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <!-- <h2 class="mb-5">Nieuwsberichten</h2> -->
          <!-- <h3>Zaken die <span>de aandacht</span> vragen</h3> -->
        
          <?php 
          if ($agenda_html != '')
            echo $agenda_html; 
            else
            echo '<h3>Helaas, er zijn geen agendapunten gepland voor de komende tijd.</h3>';
          ?>
        </div>
      </div>
    </section><!-- End Agenda Section -->
  
    <!-- <section id="agenda" class="agenda pt-0">
      
      <div class="titelbalk">
        <div id="overlay"></div>
        <div class="container-fluid titelbalk py-5"">         
          <div class="row justify-content-center">
            <div class="col-lg-6" style="z-index: 3;">
            <h4 class="text-center text-light display-2">Agenda</h4>
            </div>
          </div>
        </div>
      </div>
    <div class="container pt-3 pb-2">
      <?php // echo $agenda_html; ?>
    </div>

    </section> -->

  </main><!-- End #main -->
  <?php include_once ('includes/footer.inc'); ?>

</body>

</html>