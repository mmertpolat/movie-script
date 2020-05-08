<?php 
include("config.php");
include("fonksiyon.php");
$sitebilgi = $db->query("SELECT siteikonurl,sitelogourl FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
$reklambilgi = $db->query("SELECT * FROM reklamlar")->fetch(PDO::FETCH_ASSOC);

	$sth = $db->prepare("SELECT * FROM paketler");
    $sth->execute();
    $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

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
	<title>Ücretlendirme - <?php echo baslik(); ?></title>

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
						<h2 class="section__title">Ücretlendirme</h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="#">Ana Sayfa</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Ücretlendirme</li>
						</ul>
						<!-- end breadcrumb -->

					</div>
				</div>
			</div>
		</div>
	</section><br><center><?php echo $reklambilgi['ustbannerreklam']; ?></center>
	<!-- end page title -->

	<!-- pricing -->
	<div class="section">
		<div class="container">
			<div class="row">
				

	<!-- features -->
	<section class="section section--dark">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<h2 class="section__title section__title--no-margin">Avantajlar</h2>
				</div>
				<!-- end section title -->

				<!-- feature -->
				<div class="col-12 col-md-6 col-lg-4">
					<div class="feature">
						<i class="icon ion-ios-tv feature__icon"></i>
						<h3 class="feature__title">Ultra HD</h3>
						<p class="feature__text">Dizileri ve filmleri ultra hd kalitesinde izleyebilirsiniz, seyir keyfini en üst kalitede yaşayabilirsiniz.</p>
					</div>
				</div>
				<!-- end feature -->

				<!-- feature -->
				<div class="col-12 col-md-6 col-lg-4">
					<div class="feature">
						<i class="icon ion-ios-film feature__icon"></i>
						<h3 class="feature__title">Binlerce İçerik</h3>
						<p class="feature__text">Platformumuzda binlerce dizi ve film içeriği bulunmaktadır, sıkılmadan vakit geçireceğinize garanti verebiliriz.</p>
					</div>
				</div>
				<!-- end feature -->

				<!-- feature -->
				<div class="col-12 col-md-6 col-lg-4">
					<div class="feature">
						<i class="icon ion-ios-trophy feature__icon"></i>
						<h3 class="feature__title">Ödül Almış Filmler</h3>
						<p class="feature__text">IMDb tarafından ödüllendirilmiş ve puanı en yüksek filmleri platformumuzda ücretsiz bir şekilde izleyebilirsiniz.</p>
					</div>
				</div>
				<!-- end feature -->

				<!-- feature -->
				<div class="col-12 col-md-6 col-lg-4">
					<div class="feature">
						<i class="icon ion-ios-notifications feature__icon"></i>
						<h3 class="feature__title">İlk İzleyen Siz Olun</h3>
						<p class="feature__text">Yeni dizi ve filmler çıkar çıkmaz sitemizi kullanarak ilk izleyenlerden olabilirsiniz.</p>
					</div>
				</div>
				<!-- end feature -->

				<!-- feature -->
				<div class="col-12 col-md-6 col-lg-4">
					<div class="feature">
						<i class="icon ion-ios-rocket feature__icon"></i>
						<h3 class="feature__title">Hızlı Sunucular</h3>
						<p class="feature__text">Sunucularımız sayesinde en hızlı şekilde film ve dizileri sizlere ulaştırıyoruz.</p>
					</div>
				</div>
				<!-- end feature -->

				<!-- feature -->
				<div class="col-12 col-md-6 col-lg-4">
					<div class="feature">
						<i class="icon ion-ios-globe feature__icon"></i>
						<h3 class="feature__title">Çoklu Altyazı Desteği </h3>
						<p class="feature__text">İstediğiniz film veya diziyi 3 veya daha fazla dil destekli olarak izleyebilirsiniz.</p>
					</div>
				</div>
				<!-- end feature -->
			</div>
		</div>
	</section>
	<!-- end features -->

	<?php 
	include("parts/part4.php");
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