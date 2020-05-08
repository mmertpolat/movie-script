<?php 
include("config.php");
// reklam ayarlarını alıyoruz
$reklambilgi = $db->query("SELECT * FROM reklamlar")->fetch(PDO::FETCH_ASSOC);
// reklam ayarlarını alıyoruz
$sitebilgi = $db->query("SELECT siteeposta FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
?>
<!-- partners -->

	<section class="section">
		<center><?php echo $reklambilgi['altbannerreklam']; ?></center>
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<h2 class="section__title section__title--no-margin">Not</h2>
				</div>
				<!-- end section title -->

				<!-- section text -->
				<div class="col-12">
					<p class="section__text section__text--last-with-margin">Telif hakkına konu olan eserlerin yasal olmayan bir biçimde paylaşıldığını ve yasal haklarının çiğnendiğini düşünen hak sahipleri veya meslek birlikleri, <?php echo $sitebilgi['siteeposta']; ?> mail adresinden bize ulaşabilirler. Buraya ulaşan talep ve şikayetler hukuksal olarak incelenecek, şikayet yerinde görüldüğü takdirde, ihlal olduğu düşünülen içerikler sitemizden kaldırılacaktır.</p>
				</div>
				<!-- end section text -->
			</div>
		</div>
	</section>
	<!-- end partners -->
