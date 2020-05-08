<?php
include("config.php"); // config include
$reklambilgi = $db->query("SELECT * FROM reklamlar")->fetch(PDO::FETCH_ASSOC);
// en son eklenenler kısmındaki filmleri çekeceğiz

	$sthbegenilen = $db->prepare("SELECT * FROM filmler WHERE filmimdb > '9.0' ORDER BY filmid DESC LIMIT 6");
	$sthbegenilen->execute();
	$resultbegenilen = $sthbegenilen->fetchAll(\PDO::FETCH_ASSOC);

?>
<!-- expected premiere -->
	<section class="section section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<h2 class="section__title">En Çok Beğenilenler (IMDb +9.0)</h2>
				</div>
				<!-- end section title -->
				<?php for ($i = 0; $i < 6; $i++) { ?>
				<!-- card -->
				<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
					<div class="card">
						<div class="card__cover">
							<img src="<?php echo $resultbegenilen[$i]['filmafis']; ?>" alt="<?php echo $resultbegenilen[$i]['filmad']; ?>">
							<a href="film?ad=<?php echo $resultbegenilen[$i]['filmseourl']; ?>" class="card__play">
								<i class="icon ion-ios-play"></i>
							</a>
						</div>
						<div class="card__content">
							<h3 class="card__title"><a href="film?ad=<?php echo $resultbegenilen[$i]['filmseourl']; ?>"><?php echo $resultbegenilen[$i]['filmad']; ?></a></h3>
							<span class="card__category">
								<a href="kategori?ad=<?php echo $resultbegenilen[$i]['filmkategori']; ?>"><?php echo $resultbegenilen[$i]['filmkategori']; ?></a>
							</span>
							<span class="card__rate"><i class="icon ion-ios-star"></i><?php echo $resultbegenilen[$i]['filmimdb']; ?></span>
							<ul class="card__list">
								<li><?php echo $resultbegenilen[$i]['filmkalite']; ?></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end card -->
			<?php } ?>

				<!-- section btn -->
				<div class="col-12">
					<a href="filmler" class="section__btn">daha fazla</a>
					
				</div>
				<!-- end section btn -->
			</div>
		</div><center><?php echo $reklambilgi['altbannerreklam']; ?></center>
	</section>
	<!-- end expected premiere -->