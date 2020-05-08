.<?php 
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
	<title>Profil - <?php echo baslik(); ?></title>

</head>
<body class="body">
	
	<?php include("parts/header.php"); ?>

	<?php

	// kullanıcı bilgilerini çekeceğiz

$query = $db->query("SELECT * FROM uyeler WHERE id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
$mevcutparola = $query['password'];
$mevcutpaket = $query['paket'];

	?>

	<!-- page title -->
	<section class="section section--first section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title">Profil</h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="index">Ana Sayfa</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Profil</li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- content -->
	<div class="content">
		<!-- profile -->
		<div class="profile">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="profile__content">
							<div class="profile__user">
								<div class="profile__avatar">
									<img src="<?php echo $query['avatar']; ?>" width="60" height="60" alt="Avatar">
								</div>
								<div class="profile__meta">
									<h3><?php echo $query['email']; ?></h3>
									<span>Üye No: <?php echo $query['id']; ?></span>
								</div>
							</div>

							<!-- content tabs nav -->
							<ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">PROFİL</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">ABONELİK</a>
								</li>
							</ul>
							<!-- end content tabs nav -->

							<!-- content mobile tabs nav -->
							<div class="content__mobile-tabs content__mobile-tabs--profile" id="content__mobile-tabs">
								<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="Profile">
									<span></span>
								</div>

								<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">PROFİL</a></li>

										<li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">ABONELİK</a></li>
									</ul>
								</div>
							</div>
							<!-- end content mobile tabs nav -->
							
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- end profile -->

		<div class="container">
			<!-- content tabs -->
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
					<div class="row">
						<!-- details form -->
						<div class="col-12 col-lg-6">
							<form name="profilguncelle" action="" method="post" class="profile__form">
								<div class="row">
									<div class="col-12">
										<h4 class="profile__title">Profil Detayları</h4>
									</div>

										<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="profile__group">
											<label class="profile__label" for="firstname">Ad Soyad</label>
											<input id="firstname" type="text" required name="adsoyad" class="profile__input" value="<?php echo $query['name']; ?>">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="profile__group">
											<label class="profile__label" for="email">E-Posta</label>
											<input id="email" type="text" required name="eposta" class="profile__input" disabled value="<?php echo $query['email']; ?>">
										</div>
									</div>

									<div class="col-12">
										<button name="profilguncelle" class="profile__btn" type="submit">KAYDET</button>
									</div>
								</div>
							</form>



							
							
							<form class="profile__form" name="avatarguncelle" action="" method="post" enctype="multipart/form-data">
								<h4 class="profile__title">Profil Resmi</h4>
								<input style="font-color:white;" type="file" required name="image" class="custom-file-input">
							<button style="float:right;" class="profile__btn" type="submit" name="avatarguncelle">
								<span>GÜNCELLE</span>
							</button><br><br>
							</form>
						

						</div>
						<!-- end details form -->

						<?php

						if (isset($_POST['avatarguncelle'])) {

        $supported_image = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
            );

            $src_file_name = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
            if (!in_array($ext, $supported_image)) { ?>
                
            	<script type="text/javascript">
							Swal.fire(
  'Hata',
  'Yüklediğiniz dosyanın uzantısı geçersiz.',
  'error',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>

                <?php exit;
            }

            if(filesize($_FILES['image']['tmp_name']) > '1048576'){ ?>
                
            	<script type="text/javascript">
							Swal.fire(
  'Hata',
  'Yüklediğiniz dosyanın boyutu çok büyük, maksimum 1 MB izin verilir.',
  'error',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>

                 <?php exit;
            }

        $target = "img/avatars/".basename($_FILES['image']['name']);
        $image = 'img/avatars/'.$_FILES['image']['name'];
        $temp = explode(".", $image);
        $newfilename = 'img/avatars/'.round(microtime(true)) . '.' . end($temp);
        
        // bu satırda kullanıcının mysql değiştireceksin urlyi

        $query = $db->prepare("UPDATE uyeler SET
					avatar = :avatar
					WHERE id = :id");
					$update = $query->execute(array(
					     "avatar" => $newfilename,
					     "id" => $id
					));

        //

        if (move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)) { ?>
         
         <script type="text/javascript">
							Swal.fire(
  'Başarılı',
  'Profil resminiz güncellendi!',
  'success',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>

       <?php } else { ?>
          <script type="text/javascript">
							Swal.fire(
  'Hata',
  'Dosya boyutunu veya uzantısını kontrol ediniz.',
  'error',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>
            <?php 
        }
      }

						?>

						<!-- password form -->
						<div class="col-12 col-lg-6">
							<form name="parolaguncelle" action="" method="post" class="profile__form">
								<div class="row">
									<div class="col-12">
										<h4 class="profile__title">Parola Değiştir</h4>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="profile__group">
											<label class="profile__label" for="oldpass">Eski Parola</label>
											<input id="oldpass" type="password" required name="eskiparola" class="profile__input">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="profile__group">
											<label class="profile__label" for="newpass">Yeni Parola</label>
											<input id="newpass" type="password" required name="yeniparola" class="profile__input">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="profile__group">
											<label class="profile__label" for="confirmpass">Yeni Parola Tekrar</label>
											<input id="confirmpass" type="password" required name="yeniparolatekrar" class="profile__input">
										</div>
									</div>

									<div class="col-12">
										<button name="parolaguncelle" class="profile__btn" type="submit">KAYDET</button>
									</div>
								</div>
							</form>
						</div>
						<!-- end password form -->

					</div>
				</div><center><?php echo $reklambilgi['ustbannerreklam']; ?></center>

				<?php
				// profil bilgileri güncelleme
				if(isset($_POST['profilguncelle'])){
					$newadsoyad = htmlspecialchars($_POST['adsoyad']);

					$query = $db->prepare("UPDATE uyeler SET
					name = :name
					WHERE id = :id");
					$update = $query->execute(array(
					     "name" => $newadsoyad,
					     "id" => $id
					));
					if ( $update ){ ?>
					     
						<script type="text/javascript">
							Swal.fire(
  'Başarılı',
  'Bilgileriniz güncellendi!',
  'success',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>

					<?php } else { ?>

						<script type="text/javascript">
							Swal.fire(
  'Hata',
  'Bilgileriniz güncellenemedi.',
  'error',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>

					<?php }
				}

				?>

				<?php 

				if(isset($_POST['parolaguncelle'])){
					$eskiparola = $_POST['eskiparola'];
					$yeniparola = $_POST['yeniparola'];
					$yeniparolatekrar = $_POST['yeniparolatekrar'];

					if($eskiparola == $mevcutparola && $yeniparola == $yeniparolatekrar){

						$query = $db->prepare("UPDATE uyeler SET
					password = :password
					WHERE id = :id");
					$update = $query->execute(array(
					     "password" => $yeniparola,
					     "id" => $id
					));
					if ( $update ){ ?>
					     
						<script type="text/javascript">
							Swal.fire(
  'Başarılı',
  'Parolanız güncellendi!',
  'success',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>

					<?php }

					 } else { ?>

					 	<script type="text/javascript">
							Swal.fire(
  'Hata',
  'Parolanız güncellenemedi, bilgileri kontrol ediniz.',
  'error',
  ).then(function(){ 
   window.location.href = "profil";
   });
						</script>

					<?php }

				}

				?>

				<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
					<font color="white">Mevcut paketiniz</font>
					<div class="row">

						<!-- price -->
						<?php if($mevcutpaket == 1){
							echo $result[0]['paketicerik'];
						}
						?>
						<!-- end price -->

						<!-- price -->
						<?php if($mevcutpaket == 2){
							echo $result[1]['paketicerik'];
						}
						?>
						<!-- end price -->

						<!-- price -->
						<?php if($mevcutpaket == 3){
							echo $result[2]['paketicerik'];
						}
						?>
						<!-- end price -->
					</div>
				</div>
			</div>
			<!-- end content tabs -->
		</div>
	</div>
	<!-- end content -->

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
</body>
</html>