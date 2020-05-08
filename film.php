<?php
include("config.php");
include("fonksiyon.php");
	$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	if(!isset($_GET['ad'])){
		header('Location: index');
	}

$sitebilgi = $db->query("SELECT siteikonurl,sitelogourl FROM ayarlar")->fetch(PDO::FETCH_ASSOC);

	  $ad = htmlspecialchars($_GET['ad']);
	  $ad = str_replace("'","",$ad);
      $ad = str_replace("<","",$ad);
      $ad = str_replace(">","",$ad);
      $ad = str_replace(",","",$ad);

	$varmi = $db->query("SELECT * FROM filmler WHERE filmseourl = '$ad'")->fetchAll();
	if (!count($varmi) > 0) {
		header('Location: index');
    }

    // film bilgilerini çekiyoruz
	$sth = $db->prepare("SELECT * FROM filmler WHERE filmseourl = '$ad'");
	$sth->execute();
	$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
	$filmkategori = $result[0]['filmkategori'];
	$filmid = $result[0]['filmid'];

	// önerilen film kısmındaki filmleri çekiyoruz
	$sth2 = $db->prepare("SELECT * FROM filmler WHERE filmkategori = '$filmkategori' AND filmid != '$filmid' ORDER BY filmid DESC LIMIT 6");
	$sth2->execute();
	$result2 = $sth2->fetchAll(\PDO::FETCH_ASSOC);

	// kaç tane önerilen film geldi ona bakalım?

	$sayknk = $db->query("SELECT * FROM filmler WHERE filmkategori = '$filmkategori' AND filmid != '$filmid' ORDER BY filmid DESC LIMIT 6")->fetchAll();
	$saydim = count($sayknk);
	// filmin yorumlarini sayacagiz

	$stmtx = $db->query("SELECT * FROM yorumlar WHERE filmid = '$filmid' AND yorumonay = 1");
	$row_countx = $stmtx->rowCount();

	// filmin yorumlarini alacagiz
	$sth3 = $db->prepare("SELECT * FROM yorumlar WHERE filmid = '$filmid' AND yorumonay = 1 ORDER BY yorumid DESC");
	$sth3->execute();
	$result3 = $sth3->fetchAll(\PDO::FETCH_ASSOC);

	$reklambilgi = $db->query("SELECT * FROM reklamlar")->fetch(PDO::FETCH_ASSOC);

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
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title><?php echo $result[0]['filmad']; ?> - <?php echo baslik(); ?></title>

</head>
<body class="body">
	
<?php include("parts/header.php"); ?>
	<!-- details -->
	<section class="section details">
		<!-- details background -->
		<div class="details__bg" data-bg="img/home/home__bg.jpg"></div>
		<!-- end details background -->
<center><?php echo $reklambilgi['ustbannerreklam']; ?></center>
		<!-- details content -->
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<h1 class="details__title"><?php echo $result[0]['filmad']; ?></h1>
				</div>
				<!-- end title -->

				<!-- content -->
				<div class="col-12 col-xl-6">
					<div class="card card--details">
						<div class="row">
							<!-- card cover -->
							<div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">
								<div class="card__cover">
									<img src="<?php echo $result[0]['filmafis']; ?>" alt="">
								</div>
							</div>
							<!-- end card cover -->

							<!-- card content -->
							<div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">
								<div class="card__content">
									<div class="card__wrap">
										<span class="card__rate"><i class="icon ion-ios-star"></i><?php echo $result[0]['filmimdb']; ?></span>

										<ul class="card__list">
											<li>HD</li>
											<li><?php echo $result[0]['filmkalite']; ?></li>
										</ul>
									</div>

									<ul class="card__meta">
										<li>
										<span>Kategori:</span> 
										<a href="kategori?ad=<?php echo $result[0]['filmkategori']; ?>"><?php echo $result[0]['filmkategori']; ?></a>
									    </li>
										<li><span>Çıkış Yılı:</span> <?php echo $result[0]['filmyil']; ?></li>
									</ul>

									<div class="card__description card__description--details">
										<?php echo $result[0]['filmaciklama']; ?>
									</div>
								</div>
							</div>
							<!-- end card content -->
						</div>
					</div>
				</div>
				<!-- end content -->
				<?php if($reklambilgi['filmonureklam'] != NULL ){ ?>
				<div id="filmonureklam" class="col-12 col-xl-6">
					<?php echo $reklambilgi['filmonureklam']; ?>
					<br>
					<a id="reklamkapat" href="#">Reklamı Kapat</a>
				</div>
			<?php } ?>

			<?php if($reklambilgi['filmonureklam'] == NULL){ ?>
					<div class="col-12 col-xl-6">
					<?php echo $result[0]['filmembed']; ?>
				</div>
				<?php } ?>

				<div id="embed" class="col-12 col-xl-6">
					<?php echo $result[0]['filmembed']; ?>
				</div>



				<div class="col-12">
					<div class="details__wrap">
						<!-- availables -->
						<div class="details__devices">
							<span class="details__devices-title">İzleyebileceğiniz Platformlar</span>
							<ul class="details__devices-list">
								<li><i class="icon ion-logo-apple"></i><span>iOS</span></li>
								<li><i class="icon ion-logo-android"></i><span>Android</span></li>
								<li><i class="icon ion-logo-windows"></i><span>Windows</span></li>
								<li><i class="icon ion-md-tv"></i><span>Smart TV</span></li>
							</ul>
						</div>
						<!-- end availables -->

						<!-- share -->
						<div class="details__share">
							<span class="details__share-title">Filmi Paylaş</span>
							<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
							<ul class="details__share-list">
								<li class="facebook"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link; ?>"><i class="icon ion-logo-facebook"></i></a></li>
								<li class="twitter"><a target="_blank" href="http://twitter.com/intent/tweet/?url=<?php echo $actual_link; ?>"><i class="icon ion-logo-twitter"></i></a></li>
							</ul>
						</div>
						<!-- end share -->
					</div>
				</div>
			</div>
		</div>
		<!-- end details content -->
	</section>
	<!-- end details -->

	<!-- content -->
	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">Keşfet</h2>
						<!-- end content title -->

						<!-- content tabs nav -->
						<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Yorumlar</a>
							</li>
						</ul>
						<!-- end content tabs nav -->

						<!-- content mobile tabs nav -->
						<div class="content__mobile-tabs" id="content__mobile-tabs">
							<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<input type="button" value="Yorumlar">
								<span></span>
							</div>

							<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Yorumlar</a></li>
								</ul>
							</div>
						</div>
						<!-- end content mobile tabs nav -->
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-8 col-xl-8">
					<!-- content tabs -->
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
							<div class="row">
								<!-- comments -->
								<div class="col-12">
									<div class="comments">
										<ul class="comments__list">
										<?php

										for ($i = 0; $i < $row_countx; $i++) { ?>

											<li class="comments__item">
												<div class="comments__autor">
													<img class="comments__avatar" src="<?php echo $result3[$i]['yorumyapanavatar']; ?>" alt="">
													<span class="comments__name"><?php echo $result3[$i]['yorumyapanad']; ?></span>
													<span class="comments__time"><?php echo $result3[$i]['yorumtarih']; ?></span>
												</div>
												<p class="comments__text"><?php echo $result3[$i]['yorum']; ?></p>
												<div class="comments__actions">
													<?php 
													if(isset($_SESSION['adsoyad'])){
													if($id == $result3[$i]['yorumyapanid']){ ?>
												<a href="<?php echo $actual_link; ?>&yorumsil=<?php echo $result3[$i]['yorumid']; ?>">SİL</a>
												<?php } } ?>	
													<br>
												</div>
											</li>

											<?php } ?>
										</ul>

										<?php
										if(isset($_GET['yorumsil'])){
											$yorumsil = $_GET['yorumsil'];

											$sahibimiyim = $db->query("SELECT yorumid,yorumyapanid FROM yorumlar WHERE yorumid = '$yorumsil' AND yorumyapanid = '$id'")->fetchAll();
												if(!count($sahibimiyim) > 0){
													header('Location: index');
											    } else {
											    	$query = $db->prepare("DELETE FROM yorumlar WHERE yorumid = :yorumid");
													$delete = $query->execute(array(
													   'yorumid' => $yorumsil
													));

													if($delete){ ?>
														<script type="text/javascript">
						            Swal.fire(
				  'Başarılı',
				  'Yorumunuz silindi.',
				  'success'
				)
            </script>
													<?php }

											    }

										}
										?>

										<!-- üye giriş yapmadıysa yorum yapmaya izin verme -->

										<?php if(isset($_SESSION['adsoyad'])){ ?>
										<form action="" method="post" name="yorumekle" class="form">
											<textarea id="text" name="yorum" required class="form__textarea" placeholder="Yorumunuzu yazınız"></textarea>
											<button type="submit" name="yorumekle" class="form__btn">GÖNDER</button>
										</form>
									<?php } else {
										echo "<center><font color='white'>Yorum yapmak için üye girişi yapmalısınız.</font></center>";
									} ?>

										<!-- yorum formu end -->

									</div>
								</div>
								<!-- end comments -->
							</div>
						</div>
					</div>
					<!-- end content tabs -->
				</div>

				<?php

				if(isset($_POST['yorumekle'])){ 
					$yorum = addslashes(htmlspecialchars($_POST['yorum']));

					$query = $db->prepare("INSERT INTO yorumlar SET
						filmid = ?,
						yorumyapanid = ?,
						yorumyapanad = ?,
						yorumyapanavatar = ?,
						yorum = ?");
						$insert = $query->execute(array(
						     $filmid, $id, $yorumyapanad, $yorumyapanavatar, $yorum
						));
						if ( $insert ){
						    $last_id = $db->lastInsertId(); ?>
						    
						    <script type="text/javascript">
							Swal.fire(
  'Başarılı',
  'Yorumunuz eklendi. Yönetici onayından sonra yayınlanacaktır.',
  'success',
  ).then(function(){ 
   window.location.href = "<?php echo $actual_link; ?>";
   });
						</script>

						<?php }

				}

				?>


				<!-- sidebar -->
				<div class="col-12 col-lg-4 col-xl-4">
					<div class="row">
						<!-- section title -->
						<div class="col-12">
							<h2 class="section__title section__title--sidebar">Benzer İçerikler</h2>
						</div>
						<!-- end section title -->

						<?php 
						if($saydim > 0){
						for ($i = 0; $i < $saydim; $i++) { ?>					
						<!-- card -->
						<div class="col-6 col-sm-4 col-lg-6">
							<div class="card">
								<div class="card__cover">
									<img src="<?php echo $result2[$i]['filmafis']; ?>" alt="">
									<a href="film?ad=<?php echo $result2[$i]['filmseourl']; ?>" class="card__play">
										<i class="icon ion-ios-play"></i>
									</a>
								</div>
								<div class="card__content">
									<h3 class="card__title"><a href="#"><?php echo $result2[$i]['filmad']; ?></a></h3>
									<span class="card__category">
										<a href="#"><?php echo $result2[$i]['filmkategori']; ?></a>
									</span>
									<span class="card__rate"><i class="icon ion-ios-star"></i><?php echo $result2[$i]['filmimdb']; ?></span>
								</div>
							</div>
						</div>
						<!-- end card -->
					<?php } } else { echo "<center><font color='white'>Benzer içerik bulunamadı.</font></center>"; } ?>
						<!-- 6 tane önerilen film ekle -->
					</div>
				</div>
				<!-- end sidebar -->
			</div>
		</div>
	</section>
	<!-- end content -->
<center><?php echo $reklambilgi['altbannerreklam']; ?></center>
	<?php include("parts/footer.php"); ?>

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

			$('#embed').hide();

			$('#reklamkapat').click(function () {
				$('#filmonureklam').hide();
				$('#embed').show();
			});
			


		});
	</script>
</body>
</html>