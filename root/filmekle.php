<?php
include("../config.php");
include("../fonksiyon.php");
ob_start();
session_start();

if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>FilmGO Film Ekle</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <?php include("sync.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">FilmGO Film Ekle</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="main.php">Yönetici Paneli</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Film Ekle</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" name="filmekle" enctype="multipart/form-data" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Film Ekle</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Film Adı</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="filmad" required class="form-control" placeholder="Film adını giriniz">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Film Kategorisi</label>
                                    <div class="col-md-9">
                                        <select name="filmkategori" required class="select2 form-control custom-select" style="width: 100%; height:36px;">

                                            <!-- catları çekcez -->

                                            <?php 
                                            $query = $db->query("SELECT * FROM kategoriler", PDO::FETCH_ASSOC);
                                            if ( $query->rowCount() ){
                                                 foreach( $query as $row ){ ?>
                                                    <option value="<?php echo $row['kategoriad']; ?>"><?php echo $row['kategoriad']; ?></option>
                                                      
                                                  <?php }
                                            }
                                            ?>

                                            <!-- catları çekcez end -->

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Film Kalite</label>
                                    <div class="col-md-9">
                                        <select name="filmkalite" required class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <option value="4K">4K</option>
                                            <option value="1080P">1080P</option>
                                            <option value="720P">720P</option>
                                            <option value="640P">640P</option>
                                            <option value="480P">480P</option>
                                            <option value="360P">360P</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">IMDb Puanı</label>
                                        <div class="col-sm-9">
                                            <input name="filmimdb" required type="text" class="form-control" maxlength="3" placeholder="Film IMDb puanını giriniz">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Film Açıklaması</label>
                                        <div class="col-sm-9">
                                            <textarea name="filmaciklama" required rows="5" class="form-control" placeholder="Filmin açıklamasını giriniz"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Film Embed</label>
                                        <div class="col-sm-9">
                                            <textarea name="filmembed" required rows="5" class="form-control" placeholder="Filmin embed kodunu giriniz"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Film Çıkış Yılı</label>
                                        <div class="col-sm-9">
                                            <input name="filmyil" required type="text" class="form-control" maxlength="4" placeholder="Filmin yayınlandığı yılı giriniz">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Film Afişi (210x311)</label>
                                    <div class="col-md-9">
                                            <input required name="filmafis" type="file">
                                    </div>
                                </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <center><button type="submit" name="filmekle" class="btn btn-primary">EKLE</button></center>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>

                        <?php

                        if(isset($_POST['filmekle'])){

                            if($_FILES["filmafis"]["size"]<1024*1024 AND $_FILES["filmafis"]["type"]=="image/png" OR $_FILES["filmafis"]["type"]=="image/PNG" OR $_FILES["filmafis"]["type"]=="image/JPG" OR $_FILES["filmafis"]["type"]=="image/JPEG" OR $_FILES["filmafis"]["type"]=="image/jpeg"){

                            $filmad = $_POST['filmad'];
                            $filmkategori = $_POST['filmkategori'];
                            $filmkalite = $_POST['filmkalite'];
                            $filmimdb = $_POST['filmimdb'];
                            $dosya_adi = $_FILES["filmafis"]["name"];
                            $filmseourl = permalink($filmad);
                            $filmaciklama = $_POST['filmaciklama'];
                            $filmembed = $_POST['filmembed'];
                            $filmyil = $_POST['filmyil'];

                            $uret=array("as","rt","ty","yu","fg");
                            $uzanti=substr($dosya_adi,-4,4);
                            $sayi_tut=rand(1,10000);
                            $yeni_ad="img/covers/".$uret[rand(0,4)].$sayi_tut.$uzanti;
                            $yuklebabos = move_uploaded_file($_FILES["filmafis"]["tmp_name"],'../'.$yeni_ad);

                             // eklemeden önce böyle bir kategori var mı kontrol et

                            $filmkontrol = $db->query("SELECT filmseourl FROM filmler WHERE filmseourl = '$filmseourl'")->fetchAll();
                            if(!count($filmkontrol) > 0){

                            // eklemeden önce böyle bir kategori var mı kontrol et end

                            $eklebabos = $db->query("INSERT INTO filmler (filmad, filmkategori, filmkalite, filmimdb, filmafis, filmseourl, filmaciklama, filmembed, filmyil) VALUES ('$filmad','$filmkategori','$filmkalite','$filmimdb','$yeni_ad','$filmseourl','$filmaciklama','$filmembed','$filmyil')");

                            if($eklebabos and $yuklebabos){
                             echo '<script type="text/javascript">
                          Swal.fire(
                          "İşlem Başarılı!",
                          "Film eklendi.",
                          "success"
                        )
                          </script>';

                                }                     
                         else {
                            echo '<script type="text/javascript">
      Swal.fire(
      "Hata!",
      "Film afişinin boyutunu ve uzantısını kontrol ediniz.",
      "error"
    )
      </script>';
                        }

                        } else {
                          echo '<script type="text/javascript">
                          Swal.fire(
                          "Hata!",
                          "Aynı isimde film veritabanında mevcut.",
                          "error"
                        )
                          </script>';  
                        }

                    }
                }

                         ?>


                    </div>
                </div>

            </div>

            <footer class="footer text-center"><br>
                
            </footer>

        </div>

    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>

    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>

    <script src="dist/js/waves.js"></script>

    <script src="dist/js/sidebarmenu.js"></script>

    <script src="dist/js/custom.min.js"></script>
</body>

</html>