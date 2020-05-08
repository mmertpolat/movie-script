<?php 
include("config.php");
include("fonksiyon.php");
$sitebilgi = $db->query("SELECT siteikonurl,sitelogourl FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
if(empty($_GET['ad'])){
	header('Location: index');
}

$kategori = htmlspecialchars($_GET['ad']);
	  $kategori = str_replace("'","",$kategori);
      $kategori = str_replace("<","",$kategori);
      $kategori = str_replace(">","",$kategori);
      $kategori = str_replace(",","",$kategori);

$catvarmi = $db->query("SELECT kategoriad FROM kategoriler WHERE kategoriad = '$kategori'")->fetchAll();
$catsay = count($catvarmi);
if($catsay <= 0){
	header('Location: index');
}

$ariyorum = $db->query("SELECT filmad FROM filmler WHERE filmkategori = '$kategori'")->fetchAll();
$forsayi = count($ariyorum);

	$sthara = $db->prepare("SELECT * FROM filmler WHERE filmkategori = '$kategori' ORDER BY filmid DESC");
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
	<title><?php echo $kategori; ?> - <?php echo baslik(); ?></title>

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
						<h2 class="section__title">Kategori: <?php echo $kategori; ?></h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="#">Film Ara</a></li>
							<li class="breadcrumb__item breadcrumb__item--active"><?php echo $kategori; ?></li>
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

				<?php
$limit = 12;
$query = "SELECT * FROM filmler WHERE filmkategori = '$kategori' ORDER BY filmid DESC";

$s = $db->prepare($query);
$s->execute();
$total_results = $s->rowCount();
$total_pages = ceil($total_results/$limit);

if(!isset($_GET['page'])) {
$page = 1;
} else {
$page = $_GET['page'];
if(!is_numeric($page)){
	header('Location: index');
}
}

$starting_limit = ($page-1)*$limit;
$show = "SELECT * FROM filmler WHERE filmkategori = '$kategori' ORDER BY filmid DESC LIMIT $starting_limit, $limit";

$r = $db->prepare($show);
$r->execute();

while($res = $r->fetch(PDO::FETCH_ASSOC)):

?>
<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
					<div class="card">
						<div class="card__cover">
							<img src="<?php echo $res['filmafis']; ?>" alt="">
							<a href="film?ad=<?php echo $res['filmseourl']; ?>" class="card__play">
								<i class="icon ion-ios-play"></i>
							</a>
						</div>
						<div class="card__content">
							<h3 class="card__title"><a href="film?ad=<?php echo $res['filmseourl']; ?>"><?php echo $res['filmad']; ?></a></h3>
							<span class="card__category">
								<a href="kategori?ad=<?php echo $res['filmkategori']; ?>"><?php echo $res['filmkategori']; ?></a>
							</span>
							<span class="card__rate"><i class="icon ion-ios-star"></i><?php echo $res['filmimdb']; ?></span>
							<ul class="card__list">
										<li><?php echo $res['filmkalite']; ?></li>
									</ul>
						</div>
					</div>
				</div>

<?php
endwhile;

?>
<div class="col-12">
	<?php 
	$eksi = $page-1;
	$arti = $page+1;
	?> 
					<ul class="paginator" style="width:100%;">
						<li class="paginator__item paginator__item--prev">
							<a href="<?php echo "kategori?ad=$kategori&page=$eksi"; ?>"><i class="icon ion-ios-arrow-back"></i></a>
						</li>

<?php 
for ($page=1; $page <= $total_pages ; $page++):?>
<li class="<?php if($_GET['page'] == $page){ echo "paginator__item paginator__item--active";} else { echo "paginator__item"; } ?>"><a href="<?php echo "kategori?ad=$kategori&page=$page"; ?>"><?php echo $page; ?></a></li></a>

<?php endfor; ?>
							<li class="paginator__item paginator__item--next">
							<a href="<?php echo "kategori?ad=$kategori&page=$arti"; ?>"><i class="icon ion-ios-arrow-forward"></i></a>
						</li>
					</ul>
				</div>
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