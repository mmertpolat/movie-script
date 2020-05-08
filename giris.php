<?php  
include("config.php");
include("fonksiyon.php");
$sitebilgi = $db->query("SELECT siteikonurl,sitelogourl FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
ob_start();
session_start();
if(isset($_SESSION['adsoyad'])){
	header('Location: index');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	$analyticsbilgi = $db->query("SELECT siteanalytics FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
	echo $analyticsbilgi['siteanalytics'];
	?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> <!-- SweetAlert2 -->
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
	<title>Giriş - <?php echo baslik(); ?></title>

</head>
<body class="body">

	<div class="sign section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- authorization form -->
						<form action="" name="giris" method="post" class="sign__form">
							<a href="index" class="sign__logo">
								<img src="<?php echo $sitebilgi['sitelogourl']; ?>" alt="Logo">
							</a>

							<div class="sign__group">
								<input type="email" required name="eposta" class="sign__input" placeholder="E-Posta">
							</div>

							<div class="sign__group">
								<input type="password" required name="parola" class="sign__input" placeholder="Parola">
							</div>

							<div class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">Beni Hatırla</label>
							</div>
							
							<button class="sign__btn" name="giris" type="submit">GİRİŞ YAP</button>

							<span class="sign__text">Hesabınız yok mu? <a href="kayit">KAYIT OL</a></span>

							<span class="sign__text"><a href="#">Parolanızı mı unuttunuz?</a></span>
						</form>
						<!-- end authorization form -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
	
	$v = $db->prepare("select * from uyeler where email=? and password=?");
		
		if(isset($_POST['giris'])){

								$eposta = strip_tags($_POST['eposta']);
								$parola = strip_tags($_POST['parola']);

								$v->execute(array($eposta,$parola));

					$x = $v->fetch(PDO::FETCH_ASSOC);

					$d = $v->rowCount();

					if($d){
						
						$_SESSION["adsoyad"] = $x["name"];
						$_SESSION["eposta"] = $x["email"];
						$_SESSION["id"] = $x["id"];
						$_SESSION["avatar"] = $x["avatar"];

						$id = $_SESSION["id"];

						// login redirect //

						header('Location: index');
	
							} else { ?>

							<script type="text/javascript">
						            Swal.fire(
				  'Hata',
				  'Kullanıcı bilgileri yanlış.',
				  'error'
				)
            </script> <?php } } ?>

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