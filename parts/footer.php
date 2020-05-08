<?php $sitebilgi = $db->query("SELECT facebookurl,instagramurl,twitterurl,siteeposta FROM ayarlar")->fetch(PDO::FETCH_ASSOC); ?>
<!-- footer -->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<!-- footer list -->
				<div class="col-12 col-md-3">
					<h6 class="footer__title">MOBİL UYGULAMA</h6>
					<ul class="footer__app">
						<li><a href="#"><img src="img/Download_on_the_App_Store_Badge.svg" alt=""></a></li>
						<li><a href="#"><img src="img/google-play-badge.png" alt=""></a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-6 col-sm-4 col-md-3">
					<h6 class="footer__title">KAYNAKLAR</h6>
					<ul class="footer__list">
						<li><a href="hakkinda">Hakkında</a></li>
						<li><a href="ucretlendirme">Ücretlendirme</a></li>
						<li><a href="hakkinda">Yardım</a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-6 col-sm-4 col-md-3">
					<h6 class="footer__title">HUKUKSAL</h6>
					<ul class="footer__list">
						<li><a href="#">Kullanım Şartları</a></li>
						<li><a href="#">Gizlilik Politikası</a></li>
						<li><a href="#">Güvenlik</a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-12 col-sm-4 col-md-3">
					<h6 class="footer__title">İLETİŞİM</h6>
					<ul class="footer__list">
						<li><a href="mailto:<?php echo $sitebilgi['siteeposta']; ?>"><?php echo $sitebilgi['siteeposta']; ?></a></li>
					</ul>
					<ul class="footer__social">
						<li class="facebook"><a target="_blank" href="<?php echo $sitebilgi['facebookurl']; ?>"><i class="icon ion-logo-facebook"></i></a></li>
						<li class="instagram"><a target="_blank" href="<?php echo $sitebilgi['instagramurl']; ?>"><i class="icon ion-logo-instagram"></i></a></li>
						<li class="twitter"><a target="_blank" href="<?php echo $sitebilgi['twitterurl']; ?>"><i class="icon ion-logo-twitter"></i></a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer copyright -->
				<div class="col-12">
					<div class="footer__copyright">
						<small>FilmGO © 2020 Developed for <a href="http://erzyazilim.com" target="_blank">Software Architecture Project</a></small>

						<ul>
							<li><a href="#">Kullanım Şartları</a></li>
							<li><a href="#">Gizlilik Politikası</a></li>
						</ul>
					</div>
				</div>
				<!-- end footer copyright -->
			</div>
		</div>
	</footer>
	<!-- end footer -->