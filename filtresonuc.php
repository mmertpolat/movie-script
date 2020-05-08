<?php 
include("config.php");
include("fonksiyon.php");
$sitebilgi = $db->query("SELECT siteikonurl,sitelogourl FROM ayarlar")->fetch(PDO::FETCH_ASSOC);

// filmleri çekelim

	$sth = $db->prepare("SELECT * FROM filmler ORDER BY filmid DESC LIMIT 12");
	$sth->execute();
	$result = $sth->fetchAll(\PDO::FETCH_ASSOC);

	// filtreleme

if(empty($_POST['film_turu']) || empty($_POST['film_kalite']) || empty($_POST['film_imdb_start']) || empty($_POST['film_imdb_end']) || empty($_POST['film_yil_start']) || empty($_POST['film_yil_end']))
	{
	header('Location: index');
}

$film_turu = $_POST['film_turu'];
$film_kalite = $_POST['film_kalite'];

$film_imdb_start = $_POST['film_imdb_start'];
$film_imdb_end = $_POST['film_imdb_end'];

$film_yil_start = $_POST['film_yil_start'];
$film_yil_end = $_POST['film_yil_end'];

$gelenCatName = $db->query("SELECT kategoriad FROM kategoriler WHERE kategoriid = '$film_turu'")->fetch(PDO::FETCH_ASSOC);
$film_turu = $gelenCatName['kategoriad'];

$varmi = $db->query("SELECT * FROM filmler WHERE filmkategori = '$film_turu' AND filmyil > $film_yil_start AND filmyil < $film_yil_end AND filmkalite = '$film_kalite' AND filmimdb > $film_imdb_start AND filmimdb < $film_imdb_end")->fetchAll();
$saydim = count($varmi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	$analyticsbilgi = $db->query("SELECT siteanalytics FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
	echo $analyticsbilgi['siteanalytics'];
	?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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
	<title>Filmler - <?php echo baslik(); ?></title>

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
						<h2 class="section__title">Filmler</h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="#">Ana Sayfa</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Filmler</li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->
<form action="filtresonuc.php" id="filtreuygula" method="post" name="filtreuygula">
	<!-- filter -->
	<div class="filter">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="filter__content">
						<div class="filter__items">

							<!-- filter item -->
							<div class="filter__item" id="filter__genre">
								<span class="filter__item-label">TÜR:</span>

								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="<?php echo $film_turu; ?>">
									<input type="hidden" name="film_turu" id="film_turu" value="<?php echo $film_turu; ?>">
									<span></span>
								</div>

								<ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-genre">
								
									<?php 
                                            $query = $db->query("SELECT * FROM kategoriler", PDO::FETCH_ASSOC);
                                            if ( $query->rowCount() ){
                                                 foreach( $query as $row ){ ?>
                                                    <li class="film-turu" id="<?php echo $row['kategoriid']; ?>" value="<?php echo $row['kategoriad']; ?>"><?php echo $row['kategoriad']; ?></li>
                                                      
                                                  <?php }
                                            }
                                            ?>
								</ul>
							</div>
							<!-- end filter item -->

							<!-- filter item -->
							<div class="filter__item" id="filter__quality">
								<span class="filter__item-label">KALİTE:</span>

								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-quality" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="<?php echo $film_kalite; ?>">
									<input type="hidden" name="film_kalite" id="film_kalite" value="<?php echo $film_kalite; ?>">
									<span></span>
								</div>

								<ul id="kalite" class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-quality">
									<li id="1" value="4K">4K</li>
									<li id="2" value="1080P">1080P</li>
									<li id="3" value="720P">720P</li>
									<li id="4" value="640P">640P</li>
									<li id="5" value="480P">480P</li>
									<li id="6" value="360P">360P</li>
								</ul>
							</div>
							<!-- end filter item -->

							<!-- filter item -->
							<div class="filter__item" id="filter__rate">
								<span class="filter__item-label">IMDB:</span>

								<div class="filter__item-btn dropdown-toggle" role="button" id="filter-rate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div class="filter__range">
										<div id="filter__imbd-start"><?php echo $film_imdb_start; ?></div>
										<div id="filter__imbd-end"><?php echo $film_imdb_end; ?></div>
										<input type="hidden" value="<?php echo $film_imdb_start; ?>" name="film_imdb_start" id="film_imdb_start">
										<input type="hidden" value="<?php echo $film_imdb_end; ?>" name="film_imdb_end" id="film_imdb_end">
									</div>
									<span></span>
								</div>

								<div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-rate">
									<div id="filter__imbd"></div>
								</div>
							</div>
							<!-- end filter item -->

							<!-- filter item -->
							<div class="filter__item" id="filter__year">
								<span class="filter__item-label">ÇIKIŞ TARİHİ:</span>

								<div class="filter__item-btn dropdown-toggle" role="button" id="filter-year" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div class="filter__range">
										<div id="filter__years-start"></div>
										<div id="filter__years-end"></div>
										<input type="hidden" value="<?php echo $film_yil_start; ?>" name="film_yil_start" id="film_yil_start">
										<input type="hidden" value="<?php echo $film_yil_end; ?>" name="film_yil_end" id="film_yil_end">
									</div>
									<span></span>
								</div>

								<div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-year">
									<div id="filter__years"></div>
								</div>
							</div>
							<!-- end filter item -->
						</div>
						
						<!-- filter btn -->
						<button name="filtreuygula" id="filtreuygula" type="submit" class="filter__btn">FİLTREYİ UYGULA</button>
						<!-- end filter btn -->
					</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end filter -->

	<!-- catalog -->
	<div class="catalog">
		<div class="container">
			<div class="row">

				<?php

$limit = 12;
$query = "SELECT * FROM filmler WHERE filmkategori = '$film_turu' AND filmyil > $film_yil_start AND filmyil < $film_yil_end AND filmkalite = '$film_kalite' AND filmimdb > $film_imdb_start AND filmimdb < $film_imdb_end";
//film kategoriye göre litelem


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
$show = "SELECT * FROM filmler WHERE filmkategori = '$film_turu' AND filmyil > $film_yil_start AND filmyil < $film_yil_end AND filmkalite = '$film_kalite' AND filmimdb > $film_imdb_start AND filmimdb < $film_imdb_end ORDER BY filmid DESC LIMIT $starting_limit, $limit";

$r = $db->prepare($show);
$r->execute();

while($res = $r->fetch(PDO::FETCH_ASSOC)):

?>
<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
					<div class="card">
						<div class="card__cover">
							<img src="<?php echo $res['filmafis']; ?>" alt="<?php echo $res['filmad']; ?>">
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

if($saydim == 0){ ?>
<script type="text/javascript">
						            Swal.fire(
  'Hata',
  'Bu kriterlere uygun içerik bulunamadı.',
  'error',
  ).then(function(){ 
   window.location.href = "filmler";
   });
            </script>
<?php }

?>
<div class="col-12">
	<?php 
	$eksi = $page-1;
	$arti = $page+1;
	?> 
					<ul class="paginator" style="width:100%;">
						<li class="paginator__item paginator__item--prev">
							<a href="<?php echo "?page=$eksi"; ?>"><i class="icon ion-ios-arrow-back"></i></a>
						</li>

<?php 
for ($page=1; $page <= $total_pages ; $page++):?>
<li class="<?php if($_GET['page'] == $page){ echo "paginator__item paginator__item--active";} else { echo "paginator__item"; } ?>"><a href="<?php echo "?page=$page"; ?>"><?php echo $page; ?></a></li></a>

<?php endfor; ?>
							<li class="paginator__item paginator__item--next">
							<a href="<?php echo "?page=$arti"; ?>"><i class="icon ion-ios-arrow-forward"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- end catalog -->

	

	<?php 
	include("parts/part3.php");
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
	<script type="text/javascript">
		
		$(document).ready(function(){

			$('.film-turu').click(function () {
				var id = $(this).attr('id');
				$('#film_turu').val(id);
			});

			
				var firstSlider = document.getElementById('filter__years');
				firstSlider.noUiSlider.updateOptions({
					range: {
						'min': 2000,
						'max': 2018
					},
					step: 1,
					connect: true,
					start: [<?php echo $film_yil_start;?>, <?php echo $film_yil_end;?>],
					format: wNumb({
						decimals: 0,
					})
				});
			
			
				var secondSlider = document.getElementById('filter__imbd');
				secondSliderslider.noUiSlider.updateOptions({
					range: {
						'min': 0,
						'max': 10
					},
					step: 0.1,
					connect: true,
					start: [<?php echo $film_imdb_start;?>, <?php echo $film_imdb_end;?>],
					format: wNumb({
						decimals: 1,
					})
				});
			


		});
	</script>
</body>
</html>