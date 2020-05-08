<?php
include("../config.php");
include("../fonksiyon.php");
ob_start();
session_start();

if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

// site bilgilerini çekiyoruz
$yardimbilgi = $db->query("SELECT yardimsayfasi FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
// site bilgilerini çekiyoruz end

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
    <title>FilmGO Hakkında Sayfası Ayarları</title>
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
                        <h4 class="page-title">FilmGO Hakkında Sayfası Ayarları</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="main.php">Yönetici Paneli</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Hakkında Sayfası Ayarları</li>
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
                                <form action="" method="post" name="ayarguncelle" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Hakkında Sayfası Ayarları</h4>   
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Hakkında Sayfası İçeriği (HTML Desteklenir)</label>
                                        <div class="col-sm-9">
                                            <textarea name="yardimsayfasi" rows="25" class="form-control" placeholder="Yardım sayfası içeriğini giriniz (HTML desteklenir)"><?php echo $yardimbilgi['yardimsayfasi']; ?></textarea>
                                        </div>
                                    </div>                          
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <center><button type="submit" name="ayarguncelle" class="btn btn-primary">GÜNCELLE</button></center>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>

                        <?php
                        if(isset($_POST['ayarguncelle'])){
                            $yardimsayfasi = $_POST['yardimsayfasi'];

                            $query = $db->prepare("UPDATE ayarlar SET yardimsayfasi = :yardimsayfasi");
                            $update = $query->execute(array("yardimsayfasi" => $yardimsayfasi));

                            if($update){
                                echo '<script type="text/javascript">
                          Swal.fire(
                          "İşlem Başarılı!",
                          "Sayfa güncellendi.",
                          "success"
                        ).then(function(){ 
   window.location.href = "hakkindasayfasi.php";
   });
                          </script>';
                            } else {
                                echo '<script type="text/javascript">
                          Swal.fire(
                          "Hata!",
                          "Sayfa güncellenemedi.",
                          "error"
                        )
                          </script>';
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