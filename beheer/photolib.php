<?php
include_once('../config.php');
include_once('../class/c_user.php');

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

// Config

if (isset($_GET['q']))
	$q = $_GET['q'];
	else
	$q = 'img';
switch ($q) {
	case 'mtj':
		$titel = "Maatje foto's";
		$directory = 'fotoos_person';
		$uploadDir = __DIR__ . '/../fotoos_person/';
		$thumbDir  = __DIR__ . '/../fotoos_person/thumbs/';
		$maxSize   = 0.5 * 1024 * 1024; // 0.5 MB
		$thumbnailwidth = 100;
		$tekst = 'Foto\'s moeten voldoen aan de volgende voorwaarden:<br/>
		1. niet groter dan 0,5 Mb<br/>
		2. alleen formaat jpg, jpeg, png, gif of webp<br/>
		3. foto moet vierkant zijn<br/>';
		break;
	case 'wkz':
		$titel = "Werkzoekende foto's";
		$directory = 'fotoos_wkz';
		$uploadDir = __DIR__ . '/../fotoos_wkz/';
		$thumbDir  = __DIR__ . '/../fotoos_wkz/thumbs/';
		$maxSize   = 0.5 * 1024 * 1024; // 0.5 MB
		$thumbnailwidth = 100;
		$tekst = 'Foto\'s moeten voldoen aan de volgende voorwaarden:<br/>
		1. niet groter dan 0,5 Mb<br/>
		2. alleen formaat jpg, jpeg, png, gif of webp<br/>
		3. foto moet vierkant zijn<br/>';
		break;
	default:
		$titel = "Afbeeldingen";
		$directory = 'img';
		$uploadDir = __DIR__ . '/../img/';
		$thumbDir  = __DIR__ . '/../img/thumbs/';
		$maxSize   = 5 * 1024 * 1024; // 5 MB
		$thumbnailwidth = 200;
		$tekst = 'Afbeeldingen moeten voldoen aan de volgende voorwaarden:<br/>
		1. niet groter dan 5 Mb<br/>
		2. alleen formaat jpg, jpeg, png, gif of webp<br/>';
}

// Zorg dat directories bestaan
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
if (!is_dir($thumbDir)) mkdir($thumbDir, 0777, true);

// Feedback message init
$resultmessage = '';

// Verwijderen
if (isset($_GET['delete'])) 
{
	$file = basename($_GET['delete']); // alleen bestandsnaam
	$target = $uploadDir . $file;
	$thumbTarget = $thumbDir . $file;

	if (file_exists($target)) unlink($target);
	if (file_exists($thumbTarget)) unlink($thumbTarget);

	$resultmessage = "✔ Bestand '$file' verwijderd.";
}

// Upload verwerken

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) 
{
	$file = $_FILES['foto'];

	if ($file['error'] === UPLOAD_ERR_OK && $file['size'] <= $maxSize) {
		$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		$allowed = ['jpg','jpeg','png','gif','webp'];

		if (in_array($ext, $allowed)) {
			// Originele naam zonder path
			$origName = pathinfo($file['name'], PATHINFO_FILENAME);

			// Bestandsnaam veiliger maken
			$safeBase = strtolower($origName);
			$safeBase = preg_replace('/[^a-z0-9._-]/', '_', $safeBase); 
			$safeName = $safeBase . '.' . $ext;

			$target = $uploadDir . $safeName;
			$thumbTarget = $thumbDir . $safeName;

			if (file_exists($target) || file_exists($thumbTarget)) {
				$resultmessage = "❌ Bestand met deze naam bestaat al.";
			} else {
				if (move_uploaded_file($file['tmp_name'], $target)) {
					createThumbnail($target, $thumbTarget, 200, 200);
					$resultmessage = "✔ Upload gelukt!";
				} else {
					$resultmessage = "❌ Upload mislukt bij verplaatsen.";
				}
			}
		} else {
			$resultmessage = "❌ Ongeldig bestandstype.";
		}
	} else {
		$resultmessage = "❌ Upload mislukt (te groot of fout).";
	}
}

// Thumbnail functie
function createThumbnail($src, $dest, $w, $h) 
{
	[$origW, $origH, $type] = getimagesize($src);

	switch ($type) {
		case IMAGETYPE_JPEG: $img = imagecreatefromjpeg($src); break;
		case IMAGETYPE_PNG:  $img = imagecreatefrompng($src);  break;
		case IMAGETYPE_GIF:  $img = imagecreatefromgif($src);  break;
		case IMAGETYPE_WEBP: $img = imagecreatefromwebp($src); break;
		default: return;
	}

	$ratio = min($w / $origW, $h / $origH);
	$newW = (int)($origW * $ratio);
	$newH = (int)($origH * $ratio);

	$thumb = imagecreatetruecolor($newW, $newH);
	
	// 🔑 Transparantie fix
	if ($type !== IMAGETYPE_JPEG) {
		imagealphablending($thumb, false);
		imagesavealpha($thumb, true);
		$transparent = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
		imagefill($thumb, 0, 0, $transparent);
	}
	
	imagecopyresampled($thumb, $img, 0,0,0,0, $newW, $newH, $origW, $origH);

	switch ($type) {
		case IMAGETYPE_JPEG: imagejpeg($thumb, $dest, 85); break;
		case IMAGETYPE_PNG:  imagepng($thumb, $dest, 8);    break;
		case IMAGETYPE_GIF:  imagegif($thumb, $dest);       break;
		case IMAGETYPE_WEBP: imagewebp($thumb, $dest, 80);  break;
	}

	imagedestroy($img);
	imagedestroy($thumb);
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto"><?php echo $titel; ?></h1>
			</div>
		</div>
		<div class="container">
			<div class="row header rounded text-grey p-1">
				<div style="border-style: solid; border-color: rgb(162, 190, 255); margin: auto; padding: 15px; width: 500px; background-color: rgb(188, 227, 241); font-size: small;">
					<?php echo $tekst; ?>
				</div>
			</div>
		</div>
	
		<div class="container-fluid">
			<div class="row mt-4">
				<div class="col-md-3 p-0">
					<button type="button" class="btn btn-primary mx-3" style="width: 120px;"><a class="text-white" href="beheer.php">Menu</a></button>
				</div>

				<div class="col-md-6 p-0">
					<div class="form-group text-right">
						<form method="post" enctype="multipart/form-data" style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
						Upload een afbeelding
						<input type="file" name="foto" required>
						<button type="submit" class="btn btn-primary mx-3" style="width: 120px;">Upload</button>
						</form>
					</div>
				</div>
				<div class="col-md-3 p-0">
					<?php echo $resultmessage; ?>
				</div>

			</div>				
		</div>

		
		
		
		
		<div class="container-fluid" style="padding-bottom: 80px;">	
			<div class="row">
				<div class="col-12">					
					<div style="display:flex; flex-wrap:wrap; gap:20px;">
					<?php
						foreach (glob($thumbDir . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) as $thumb) 
						{
							$file = basename($thumb);
							echo "<div style='text-align:center; width: ' . $thumbnailwidth + 20 . 'px;'>
									<a href='../$directory/$file' target='_blank'>
										<img src='../$directory/thumbs/$file' style='max-width: ' . $thumbnailwidth . 'px; height:auto; display:block; margin:0 auto; background-color: white;'>
									</a>
									<div style='margin-top:5px; font-size:14px; word-wrap:break-word;'>$file</div>
									<a href='?delete=$file&q=$q' onclick=\"return confirm('Weet je zeker dat je $file wilt verwijderen?');\">
										<i class='fa-regular fa-trash-can'></i>
									</a>
								</div>";
						}
					?>
			<!-- </form> -->
					</div>
				</div>
			</div>
		</div>
<?php include('../includes/footer.inc'); ?>

</body>
</html>
