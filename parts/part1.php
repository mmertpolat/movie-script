<?php
include("config.php"); // config include

// en son eklenenler kısmındaki filmleri çekeceğiz

	$sth = $db->prepare("SELECT * FROM filmler ORDER BY filmid DESC LIMIT 4");
	$sth->execute();
	$result = $sth->fetchAll(\PDO::FETCH_ASSOC);

// reklam ayarlarını alıyoruz
$reklambilgi = $db->query("SELECT * FROM reklamlar")->fetch(PDO::FETCH_ASSOC);
// reklam ayarlarını alıyoruz

?>

<!-- home -->
	<section class="home">
		<!-- home bg -->
		<div class="owl-carousel home__bg">
			<div class="item home__cover" data-bg="img/home/home__bg.jpg"></div>
			<div class="item home__cover" data-bg="img/home/home__bg2.jpg"></div>
			<div class="item home__cover" data-bg="img/home/home__bg3.jpg"></div>
			<div class="item home__cover" data-bg="img/home/home__bg4.jpg"></div>
		</div>
		<!-- end home bg -->
		<center><?php echo $reklambilgi['ustbannerreklam']; ?></center>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="home__title"><b>EN SON</b> EKLENENLER</h1>

					<button class="home__nav home__nav--prev" type="button">
						<i class="icon ion-ios-arrow-round-back"></i>
					</button>
					<button class="home__nav home__nav--next" type="button">
						<i class="icon ion-ios-arrow-round-forward"></i>
					</button>
				</div>

				<div class="col-12">
					<div class="owl-carousel home__carousel">

						<?php

						for ($i = 0; $i <= 3; $i++) { ?>
									    
							<div class="item">
							<div class="card card--big">
								<div class="card__cover">
									<img width="210" height="311" src="<?php echo $result[$i]['filmafis'] ?>" alt="<?php echo $result[$i]['filmad'] ?>">
									<a href="film?ad=<?php echo $result[$i]['filmseourl'] ?>" class="card__play">
										<i class="icon ion-ios-play"></i>
									</a>
								</div>
								<div class="card__content">
									<h3 class="card__title"><a href="film?ad=<?php echo $result[$i]['filmseourl'] ?>"><?php echo $result[$i]['filmad'] ?></a></h3>
									<span class="card__category">
										<a href="kategori?ad=<?php echo $result[$i]['filmkategori'] ?>"><?php echo $result[$i]['filmkategori'] ?></a>
									</span>
									<span class="card__rate"><i class="icon ion-ios-star"></i><?php echo $result[$i]['filmimdb'] ?></span>
									<ul class="card__list">
									<li><?php echo $result[$i]['filmkalite'] ?></li>
									</ul>
								</div>
							</div>
						</div>

									<?php }

						?>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end home -->