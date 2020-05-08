<?php 
include("config.php");
include("fonksiyon.php");
$sitebilgi = $db->query("SELECT siteikonurl,sitelogourl FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
if(empty($_POST['aramakelime'])){
	header('Location: index');
}
$aramakelime = htmlspecialchars(strip_tags($_POST['aramakelime']));
$ariyorum = $db->query("SELECT filmad FROM filmler WHERE filmad like '%$aramakelime%'")->fetchAll();
$forsayi = count($ariyorum);

	$sthara = $db->prepare("SELECT * FROM filmler WHERE filmad like '%$aramakelime%'");
	$sthara->execute();
	$resultara = $sthara->fetchAll(\PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	$analyticsbilgi = $db->query("SELECT siteanalytics FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
	echo $analyticsbilgi['siteanalytics'];
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet"> 

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/default-skin.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Favicons -->
<link rel="icon" type="image/png" href="<?php echo $sitebilgi['siteikonurl']; ?>" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">
	<link rel="apple-touch-icon" sizes="72x72" href="icon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="icon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="icon/apple-touch-icon-144x144.png">

	<meta name="description" content="<?php echo aciklama(); ?>">
	<title>Arama - <?php echo baslik(); ?></title>

</head>
<body class="body">
	<?php include("parts/header.php"); ?>

	<!-- page title -->
	<section class="section section--first section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title">Arama Sonuçları: <?php echo $aramakelime; ?></h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="#">Film Ara</a></li>
							<li class="breadcrumb__item breadcrumb__item--active"><?php echo $aramakelime; ?></li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<br><br>

	<!-- catalog -->
	<div class="catalog">
		<div class="container">
			<div class="row">
				<?php if($forsayi == 0){ echo "<font color='white'>Aradığınız kriterlere uygun film bulunamadı.</font>"; } ?>
				<?php for ($i = 0; $i < $forsayi; $i++) { ?>
				<!-- card -->
				<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
					<div class="card">
						<div class="card__cover">
							<img src="<?php echo $resultara[$i]['filmafis']; ?>" alt="">
							<a href="film?ad=<?php echo $resultara[$i]['filmseourl']; ?>" class="card__play">
								<i class="icon ion-ios-play"></i>
							</a>
						</div>
						<div class="card__content">
							<h3 class="card__title"><a href="film?ad=<?php echo $resultara[$i]['filmseourl']; ?>"><?php echo $resultara[$i]['filmad']; ?></a></h3>
							<span class="card__category">
								<a href="kategori?ad=<?php echo $resultara[$i]['filmkategori']; ?>"><?php echo $resultara[$i]['filmkategori']; ?></a>
							</span>
							<span class="card__rate"><i class="icon ion-ios-star"></i><?php echo $resultara[$i]['filmimdb']; ?></span>
							<ul class="card__list">
								<li><?php echo $resultara[$i]['filmkalite']; ?></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end card -->
			<?php } ?>

			</div>
		</div>
	</div>
	<!-- end catalog -->

	

	<?php 
	include("parts/footer.php"); 
	?>

	<!-- JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.min.js"></script>
	<script src="js/wNumb.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/plyr.min.js"></script>
	<script src="js/jquery.morelines.min.js"></script>
	<script src="js/photoswipe.min.js"></script>
	<script src="js/photoswipe-ui-default.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>