<?php
include("../config.php");
include("../fonksiyon.php");
ob_start();
session_start();

if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

    $sth = $db->prepare("SELECT * FROM uyeler ORDER BY id DESC");
    $sth->execute();
    $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

    $var = $db->query("SELECT * FROM uyeler ORDER BY id DESC")->fetchAll();
    $say = count($var);
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
    <title>FilmGO Üye Ayarları</title>
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
                        <h4 class="page-title">FilmGO Üye Ayarları</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="main.php">Yönetici Paneli</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Üye Ayarları</li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Üyeler</h4>
                            </div>
                            <div class="comment-widgets scrollable">
                                <form action="" method="post" name="yorumislem">
                                <!-- Comment Row -->
                                                        <?php
$limit = 4;
$query = "SELECT * FROM uyeler ORDER BY id DESC";

$s = $db->prepare($query);
$s->execute();
$total_results = $s->rowCount();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
$page = 1;
} else{
$page = $_GET['page'];
}



$starting_limit = ($page-1)*$limit;
$show = "SELECT * FROM uyeler ORDER BY id DESC LIMIT $starting_limit, $limit";

$r = $db->prepare($show);
$r->execute();

while($res = $r->fetch(PDO::FETCH_ASSOC)): 
?>
<div class="d-flex flex-row comment-row m-t-0">
                                    <div class="p-2"><img src="../<?php echo $res['avatar']; ?>" alt="user" width="50" class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium"><?php echo $res['name']; ?></h6>
                                        <span class="m-b-15 d-block"><?php echo $res['email']; ?> </span>
                                        <span class="m-b-15 d-block">Mevcut Paket: <?php echo $res['paket']; ?> </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right"><b><a style="color:black;">Üyelik Tarihi: <?php echo $res['time']; ?></span> 
                                            <a href="uyeayarlari.php?islem=uyesil&id=<?php echo $res['id']; ?>" class="btn btn-danger btn-sm">Sil</a>
                                        </div>
                                    </div>
                                </div>
<?php
endwhile;


for ($page=1; $page <= $total_pages ; $page++):?>

<a style="font-size:30px;<?php if($_GET['page'] == $page){ echo "color:black;"; } ?>" href='<?php echo "?page=$page"; ?>' class="links"><?php echo $page; ?>
</a>

<?php endfor; ?>
                        </form>
                                <!-- Comment Row -->                              
                            </div>
                        </div>

                        <?php 
                        
                        if(isset($_GET['islem']) && $_GET['islem'] == 'uyesil')
                        {
                            $silinecekyorum = $_GET['id'];
                        
                            $query = $db->prepare("DELETE FROM uyeler WHERE id = :id");
                            $delete = $query->execute(array(
                               'id' => $silinecekyorum
                            ));

                            if($delete){ ?>

                                <script type="text/javascript">
                                       Swal.fire(
                                      'İşlem Başarılı!',
                                      'Üye silindi.',
                                      'success',
                                      ).then(function(){ 
                                       window.location.href = "uyeayarlari.php";
                                       });
                                                        </script>

                            <?php } else { ?>

                                <script type="text/javascript">
                                       Swal.fire(
                                      'Hata!',
                                      'Üye silinemedi.',
                                      'error',
                                      ).then(function(){ 
                                       window.location.href = "uyeayarlari.php";
                                       });
                                                        </script>

                            <?php }

                        }

                        ?>
                        


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