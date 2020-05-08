<?php
include("config.php"); // config include

// güncel içerikler için film çekiyoruz

	$sthguncel = $db->prepare("SELECT * FROM filmler ORDER BY filmid DESC LIMIT 12");
	$sthguncel->execute();
	$resultguncel = $sthguncel->fetchAll(\PDO::FETCH_ASSOC);

	// sitedeki kategorileri say

	$catara = $db->query("SELECT * FROM kategoriler ORDER BY kategoriid ASC LIMIT 13")->fetchAll();
	$catsay = count($catara);

// sitedeki kategorileri çek

	$sthcat = $db->prepare("SELECT * FROM kategoriler ORDER BY kategoriid ASC LIMIT 13");
	$sthcat->execute();
	$resultcat = $sthcat->fetchAll(\PDO::FETCH_ASSOC);

?>
<!-- content -->
	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">Güncel İçerikler</h2>
						<!-- end content title -->

						<!-- content tabs nav -->
						<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">

							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="true">Filmler</a>
							</li>
							<?php for ($i = 0; $i < $catsay; $i++) { ?>
								<li class="nav-item">
								<a class="nav-link" href="kategori?ad=<?php echo $resultcat[$i]['kategoriad']; ?>"><?php echo $resultcat[$i]['kategoriad']; ?></a>
							</li>
						<?php } ?>

						</ul>
						<!-- end content tabs nav -->

						<!-- content mobile tabs nav -->
						<div class="content__mobile-tabs" id="content__mobile-tabs">
							<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<input type="button" value="New items">
								<span></span>
							</div>

							<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="true">Filmler</a></li>
								</ul>
							</div>
						</div>
						<!-- end content mobile tabs nav -->
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<!-- content tabs -->
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
					<div class="row">
						<?php for ($i = 0; $i < 12; $i++) { ?>
						<!-- card -->
						<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
							<div class="card">
								<div class="card__cover">
									<img src="<?php echo $resultguncel[$i]['filmafis']; ?>" alt="<?php echo $resultguncel[$i]['filmad']; ?>">
									<a href="film?ad=<?php echo $resultguncel[$i]['filmseourl']; ?>" class="card__play">
										<i class="icon ion-ios-play"></i>
									</a>
								</div>
								<div class="card__content">
									<h3 class="card__title"><a href="film?ad=<?php echo $resultguncel[$i]['filmseourl']; ?>"><?php echo $resultguncel[$i]['filmad']; ?></a></h3>
									<span class="card__category">
										<a href="kategori?ad=<?php echo $resultguncel[$i]['filmkategori']; ?>"><?php echo $resultguncel[$i]['filmkategori']; ?></a>
									</span>
									<span class="card__rate"><i class="icon ion-ios-star"></i><?php echo $resultguncel[$i]['filmimdb']; ?></span>
									<ul class="card__list">
										<li><?php echo $resultguncel[$i]['filmkalite']; ?></li>
									</ul>
								</div>
							</div>
						</div>
					<?php } ?>
						<!-- end card -->

					</div>
				</div>
			</div>
			<!-- end content tabs -->
		</div>
	</section>
	<!-- end content -->