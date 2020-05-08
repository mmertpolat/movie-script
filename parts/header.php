	<?php 
	ob_start();
	session_start(); 
if(isset($_SESSION['adsoyad'])){
	$ad = $_SESSION['adsoyad'];
	$yorumyapanad = $_SESSION['adsoyad'];
	$yorumyapanavatar = $_SESSION['avatar'];
	$eposta = $_SESSION['eposta'];
	$id = $_SESSION['id'];
	} ?>
	<!-- header -->
	<header class="header">
		<div class="header__wrap">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__content">
							<!-- header logo -->
							<a href="index" class="header__logo">
								<img src="<?php echo $sitebilgi['sitelogourl']; ?>" alt="Logo">
							</a>
							<!-- end header logo -->

							<!-- header nav -->
							<ul class="header__nav">
								<!-- dropdown -->
								<li class="header__nav-item">
									<a href="index" class="header__nav-link">ANA SAYFA</a>
								</li>
								<!-- end dropdown -->

								<!-- dropdown -->
								<li class="header__nav-item">
									<a href="filmler" class="header__nav-link">FİLMLER</a>
								</li>
								<!-- end dropdown -->

								<li class="header__nav-item">
									<a href="ucretlendirme" class="header__nav-link">ÜCRETLENDİRME</a>
								</li>

								<li class="header__nav-item">
									<a href="hakkinda" class="header__nav-link">HAKKINDA</a>
								</li>
								<?php if(isset($_SESSION['adsoyad'])){ ?>
									<li class="header__nav-item">
									<a href="profil" class="header__nav-link">PROFİL</a>
								</li>
							<?php } ?>

							<!-- dropdown -->
								<li class="dropdown header__nav-item">
									<a class="dropdown-toggle header__nav-link header__nav-link--more" href="#" role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon ion-ios-more"></i></a>

									<ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuMore">
										<?php 
                                            $query = $db->query("SELECT * FROM kategoriler", PDO::FETCH_ASSOC);
                                            if ( $query->rowCount() ){
                                                 foreach( $query as $row ){ ?>
                                                    <li><a href="kategori?ad=<?php echo $row['kategoriad']; ?>"><?php echo $row['kategoriad']; ?></a></li>
                                                      
                                                  <?php }
                                            }
                                            ?>
									</ul>
								</li>
								<!-- end dropdown -->

							</ul>
							<!-- end header nav -->

							<!-- header auth -->
							<div class="header__auth">
								<button class="header__search-btn" type="button">
									<i class="icon ion-ios-search"></i>
								</button>
								<?php if(!isset($_SESSION['adsoyad'])){ ?>
								<a href="giris" class="header__sign-in">
									<i class="icon ion-ios-log-in"></i>
									<span>GİRİŞ YAP</span>
								</a>
							<?php } elseif(isset($_SESSION['adsoyad'])){ ?>

									<a href="?cikisyap" class="header__sign-in">
									<i class="icon ion-ios-log-in"></i>
									<span>ÇIKIŞ</span>
								</a>
								
							<?php } ?>

							<?php if(isset($_GET['cikisyap'])){
                                           session_destroy();
                                     header('Location: index');
                                                                 }
                                                                ?>

							</div>
							<!-- end header auth -->

							<!-- header menu btn -->
							<button class="header__btn" type="button">
								<span></span>
								<span></span>
								<span></span>
							</button>
							<!-- end header menu btn -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- header search -->
		<form action="aramasonuc.php" name="filmara" method="post" class="header__search">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__search-content">
							<input type="text" minlength="3" required maxlength="35" name="aramakelime" placeholder="Herhangi bir dizi veya film ismi giriniz">
							<button type="submit" name="filmara">ara</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- end header search -->
	</header>
	<!-- end header -->